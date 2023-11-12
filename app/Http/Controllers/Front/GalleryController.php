<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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

        $categories=product::paginate(5);
        return view('front.gallery', compact('categories'));

    
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
