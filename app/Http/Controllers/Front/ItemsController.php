<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(Request $request, $categoryId){
        $perPage = 10;

        $products = Product::where('category_id', $categoryId)
            ->paginate($perPage);
    
        return view('products.index', compact('products'));
    }
}
