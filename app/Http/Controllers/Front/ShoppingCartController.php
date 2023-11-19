<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
class ShoppingCartController extends Controller
{
    public function index(){
        $carts = Cart::with('product')->where('client_id',1)->get();
       
                             
       return view('front.shopping-cart',compact('carts'));        
    }

    public function update(Request $request)

    {

        if($request->id && $request->quantity){

            $cart[$request->id]["quantity"] = $request->quantity;

           Cart::where('id',$request->id)->update(['count'=>$request->quantity]);
           
           $updatedPrice = $this->calculateUpdatedPrice($request->id, $request->quantity);


            session()->flash('success', 'Cart updated successfully');

            return response()->json(['updatedPrice' => $updatedPrice]);


        }

    }

    private function calculateUpdatedPrice($itemId, $newQuantity)
    {
        $cart = Cart::where('id',$itemId)->first();
        // Dummy logic: Multiply the quantity by a fixed price
        $fixedPrice = $cart->productPrice->price; // Replace with your actual price
        $updatedPrice = $fixedPrice * $newQuantity;

        return $updatedPrice;
    }
}
