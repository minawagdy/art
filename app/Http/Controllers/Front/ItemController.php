<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;

class ItemController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $productCategories = Product::where('category_id',$product->category_id)->take(8)->get();
        $category    = Category::withCount('products')->get();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });
        return view('front.item',compact('product','productCategories','categories'));
    }
}