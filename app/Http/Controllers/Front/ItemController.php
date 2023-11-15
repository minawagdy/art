<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ItemController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $productCategories = Product::where('category_id',$product->category_id)->take(8)->get();
        return view('front.item',compact('product','productCategories'));
    }
}
