<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index(){

        $pages = Page::all();
        
        return view('admin.page.index',compact('pages'));
    }

    public function create(){
        
        return view('admin.page.create');
    }


    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/pages', $imageName); // Store the image in the storage directory
            $validatedData['image'] = 'storage/pages/' . $imageName; // Save the image path in the database
        }

        $page = Page::create($validatedData);

        // Optionally, you can return a response indicating success or redirect somewhere
        // return response()->json(['message' => 'Item created successfully', 'item' => $item], 201);
        return redirect()->route('page.index')->with('success', 'Item created successfully');
    }

    public function edit($id){
        $page = Page::find($id);
        return view ('admin.page.edit',compact('page'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow the image to be optional for update
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $itemData = [
            'title_en' => $validatedData['title_en'],
            'title_ar' => $validatedData['title_ar'],
            'description_en' => $validatedData['description_en'],
            'description_ar' => $validatedData['description_ar'],
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/pages', $imageName);
            $itemData['image'] = 'storage/pages/' . $imageName;
        }

        $page = Page::find($id);

        if ($page) {
            $page->update($itemData); // Update existing item if found
            return redirect()->route('page.index')->with('success', 'Item updated successfully');
        }
    }

    
    public function destroy($id)
    {
        $page = Page::find($id);

        $page->delete();

        return redirect()->route('page.index')->with('success', 'Item deleted successfully');
    }

}
