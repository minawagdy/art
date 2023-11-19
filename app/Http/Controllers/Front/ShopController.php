<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Session;

class ShopController extends Controller
{
    public function index(){
        
        $country_id  = Session::get('country')->id;
        
        $products = Product::with('provider')->whereHas('provider',function($query) use ($country_id){
            $query->where('country',$country_id)->where('published','1')->where('status',1);
        })->where('is_active',1)->orderby('id','desc')->paginate(15);
        
        $category = Category::where('published',1)->get();
        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id,json_decode($row->country));
        });
        $cart=Cart::where('client_id',1)->get();

        $shoppingBagCount = @$cart[0]->sum_cart['count'];
        $totalPrice       = @$cart[0]->sum_cart['sum'];

        // $totalPrice    =  Cart::whereHas('productPrice', function ($q) {
        //     $q->select(\DB::raw('SUM(price) as total_price'));
        // })->sum('productPrice.total_price');

         
        return view('front.shop',compact('products','categories','shoppingBagCount','totalPrice'));
    }

    public function addToCart(Request $request)
    {
        $product_id  = $request->input('product_id');
        $count       = $request->input('count');
        $client_id   = $request->input('client_id');
        $price_id    = $request->input('price_id');

        // Retrieve the product from the database
        $product = Product::find($product_id);

        // Perform any necessary validation or checks
$existingCartItem = Cart::where('product_id', $product_id)
                                ->where('client_id', $client_id)
                                ->first();


if($existingCartItem){
    return response()->json(['message' => 'Product Is already added']);
}else{
        // Create a new cart item
        $cartItem             = new Cart;
        $cartItem->product_id = $product_id;
        $cartItem->count      = $count;
        $cartItem->client_id  = $client_id;
        $cartItem->price_id   = $price_id;
        $cartItem->save();

          // Retrieve the updated shopping bag count
          $cart = Cart::where('client_id',$client_id)->get();

          $shoppingBagCount = @$cart[0]->sum_cart['count'];
          $totalPrice       = @$cart[0]->sum_cart['sum'];
  


        return response()->json(['success' => true,'message' => 'Product added to cart successfully','shoppingBagCount' => $shoppingBagCount,'totalPrice'=>$totalPrice]);

    }
}
}