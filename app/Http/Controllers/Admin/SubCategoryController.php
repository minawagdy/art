<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Session;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
               
        $country_id  = Session::get('country')->id;
     
        $subcategoryNotApprovedCount = $subcategories->where('published',0)->count();
        
        // ->filter(function ($row) use ($country_id) {
            // return in_array($country_id, json_decode($row->country));
        // });


        return view('admin.subcategory.index',compact('subcategories','subcategoryNotApprovedCount'));

    }

    public function updateCheckbox($id,$value)
    {
         
        $subcategory = SubCategory::find($id);
        $subcategory->published = $value;
        $subcategory->save();

        return $subcategory;
    }

    public function create(){
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });
        
        return view('admin.subcategory.create',compact('categories'));
    }



    public function store(Request $request)
    {
       $validatedData     = $request->validate([
            'title_en'    => 'required|max:200',
            'title_ar'    => 'required|max:200',
            'category_id' => 'required'
        ]);

        $title_en    = $request->input('title_en');
        $title_ar    = $request->input('title_ar');
        $category_id = $request->input('category_id');

        SubCategory::create([
            'title_en'     => $title_en,
            'title_ar'     => $title_ar,
            'category_id'  => $category_id
        ]);

        return redirect('admin/subcategories');


            }
     
  
    public function edit($id)
    {
        $subcategory= SubCategory::find($id);
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });
        return view('admin.subcategory.edit', compact('subcategory','categories'));
    }

    public function update($id, Request $request)
    {
         $request->validate([
            'title_en' => 'required|max:200',
            'title_ar' => 'required|max:200',
            'category_id'  => 'required'
        ]);

        $title_en    = $request->input('title_en');
        $title_ar    = $request->input('title_ar');
        $category_id = $request->input('category_id');

        SubCategory::where('id',$id)->update([
            'title_en' => $title_en,
            'title_ar' =>  $title_ar,
            'category_id'  => $category_id
        ]);

        return redirect('admin/subcategories');

    }

    public function destroy($id)
    {
        SubCategory::destroy($id);
        return redirect('admin/subcategories');

    }
}
