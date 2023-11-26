<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Session;
use Auth;

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
        $previousItem = Product::where('id','<',$id)->orderby('id','desc')->first();
        $nextItem     = Product::where('id','>',$id)->orderby('id','asc')->first();


        return view('front.item',compact('product','productCategories','categories','previousItem','nextItem'));
    }

    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            
        $client_id = auth()->user()->id;
        $priceid = $request->input('size');
        $count   = $request->input('count');
        $product = $request->input('product');

        $existingItem = Cart::where('price_id', $priceid)
                                ->where('client_id', $client_id)
                                ->where('product_id',$product)
                                ->first();

            if ($existingItem) {
                // Item with the same size already exists in the cart, you can handle this scenario accordingly
                return response()->json(['error' => 'Item already exists in the cart']);
            }

        // Save to the cart table (adjust this to fit your actual cart table structure)
        $orderItem = new Cart();
        $orderItem->client_id      = $client_id;
        $orderItem->count          = $count;
        $orderItem->price_id       = $priceid;
        $orderItem->product_id     = $product;



        // Add other necessary data for cart entry
        $orderItem->save();

        return response()->json(['success' => true]);
    }else {
        // User is not logged in, redirect to the login page
        return response()->json(['error' => 'Authentication required'], 401); // 401: Unauthorized status code
    }
}


    
}
