<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    public function index()
    {
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });

      
        $categorytNotApprovedCount = $category->where('published',0)->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });

        return view('admin.category.index',compact('categories','categorytNotApprovedCount'));

    }

    public function updateCheckbox($id,$value)
    {
         
        $category = Category::find($id);
        $category->published = $value;
        $category->save();

        return $category;
    }

    public function create(){
        return view('admin.category.create');
    }



    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'title_en' => 'required|max:200',
            'title_ar' => 'required|max:200',
            'country'  => 'required'
        ]);

        $title_en    = $request->input('title_en');
        $title_ar    = $request->input('title_ar');
        $countryJson = json_encode($request->input('country'));

        $category  = Category::create([
            'title_en' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'country'  => $countryJson
        ]);

        return redirect('admin/categories');


            }
     
  
    public function edit($id)
    {
        $category= Category::find($id);
      
        return view('admin.category.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
         $request->validate([
            'title_en' => 'required|max:200',
            'title_ar' => 'required|max:200',
            'country'  => 'required'
        ]);

        $title_en    = $request->input('title_en');
        $title_ar    = $request->input('title_ar');
        $countryJson = json_encode($request->input('country'));

        $category  = Category::where('id',$id)->update([
            'title_en' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'country'  => $countryJson
        ]);

        return redirect('admin/categories');

    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('admin/categories');

    }

   



    
}
