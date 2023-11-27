<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductPrice;
class ShoppingCartController extends Controller
{
    public function index(){
        $carts = Cart::with('product')->where('client_id',auth()->user()->id)->get();
       
                             
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

    public function fetchText(Request $request)
    {
        // Retrieve the selected option from the request
        $selectedOption = $request->input('option');

        $pp=ProductPrice::where('id',$selectedOption)->first();
        $text = $pp->price; 
        $updatedPrice = $text * 1;

        return response()->json([
            'itemCount' => $itemCount,
            'totalPrice' => $totalPrice,
        ]);

        return response()->json(['text' => $text,'updatedPrice'=>$updatedPrice]);
    }

    public function getCartInfo(Request $request)
    {
        // Create an instance of your CartItem model
        $cartItem = new Cart();

        // Call the getSumCartAttribute method to retrieve cart information
        $cartInfo = $cartItem->getSumCartAttribute();

        // $cartInfo will contain the 'sum' and 'count' keys with their respective values
        $sum = $cartInfo['sum'];
        $count = $cartInfo['count'];

        // Now you can use $sum and $count as needed in your controller logic

        // For example, returning as JSON response
        return response()->json([
            'totalPrice' => $sum,
            'itemCount' => $count,
        ]);

    }
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        
        // Logic to validate and apply the coupon
        // Replace this with your coupon validation and discount calculation logic
        // For example:
        $promoCode=PromoCode::where('expiry_date','>=',)
        $validCouponCodes = ['COUPON123', 'DISCOUNT456'];
        
        if (in_array($couponCode, $validCouponCodes)) {
            // Coupon is valid, return discount details
            return response()->json([
                'success' => true,
                'discount' => 10, // Example discount percentage or amount
                'message' => 'Coupon applied successfully!',
            ]);
        } else {
            // Coupon is invalid
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code. Please try again.',
            ]);
        }
    }
    public function remove(Request $request)

    {

        if($request->id) {


          Cart::where('id',$request->id)->delete();
            }

            session()->flash('success', 'Product removed successfully');

        }

    }

