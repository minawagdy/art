<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Countries;
use App\Models\Gov;
use App\Models\Zones;
use App\Models\Order;
use App\Models\Address;
use App\Models\Cart;

class ShopCheckoutCartController extends Controller
{
    public function index(){
        $client  = Customer::with('address')->where('id',8)->first();
        $countries = Countries::all();
        $carts = Cart::with('product')->where('client_id',auth()->user()->id)->get();

    

        return view('front.shop-checkout',compact('client','countries','carts'));
    }

    public function store(Request $request)

    {
        if($request->country!=null){
            $newAddress                  = new Address();
            $newAddress->area            = $request->zone;
            $newAddress->building_number = $request->building_number;
            $newAddress->floor_number    = $request->floor_number;
            $newAddress->flat_number     = $request->flat_number;
            $newAddress->street          = $request->street;
            $newAddress->building_type   = $request->building_type;
            $newAddress->client_id       = 1;
            $newAddress->is_active       = 1;
            $newAddress->save();
        }
        $order = new Order();
        if($request->address!=0){
        $order->address_id = $request->address;
        }else{
            $order->address_id =  $newAddress->id;
        }
        $order->provider_id    = 1;
        $order->client_id      = 1;
        $order->payment_method = 57;
        $order->delivery_fees  = 0;
        $order->status_id      = 1;
        $order->provider_fees  = 0;

        // Set other fields as needed

        // Save the model to the database
        $order->save();

        if($request->address!=null){
        $address        = $request->address;
        $provider_id    = 1;
        $client_id      = 1;
        $payment_method = 57;
        $address_id     = 1;

        }
    }


    public function getCities($country)
    {
        $cities = Gov::where('country_id', $country)->where('published',1)->pluck('title', 'id');

        return response()->json($cities);
    }

    public function getAreas($city)
    {
        $areas = Zones::where('gov_id',$city)->pluck('name', 'id');

        return response()->json($areas);
    }
}
