<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ItemDetailsController extends Controller
{
   public function index(){
    $categories = Category::withCount('products')->get();

    dd($categories);
   }
}
