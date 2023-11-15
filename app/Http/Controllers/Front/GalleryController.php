<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class GalleryController extends Controller
{
    public function index(){
    
        // $categories = Category::with(['products' => function ($query) {
        //     $query->where('is_active', 1)
        //           ->with('images')
        //           ->select('products.*')
        //           ->paginate(5);
        // }])
        
        // ->where('published', 1)
        // ->get();

        
        $category       = Category::where('published',1)->get();

        $categories = $category->filter(function ($row)  {
            return in_array(session()->get('country')->id, json_decode($row->country));
        });

        // $products=Product::take(5)->get();
        $products = Product::paginate(5);

        // paginate(5);
// dd($products);
        return view('front.gallery', compact('products','categories'));

    
    }

    public function loadMoreData(Request $request)
    {
        $start = $request->input('start');

        $data = product::orderBy('id','asc')
                  ->offset($start)
                  ->limit(5)
                  ->get();
        

        return response()->json([
            'data' => $data,
            'next' => $start + 5
        ]);
    }
}
