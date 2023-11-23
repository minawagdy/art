<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Countries;
use App\Models\Gov;
use App\Models\Zones;


class ShopCheckoutCartController extends Controller
{
    public function index(){
        $client  = Customer::with('address')->where('id',8)->first();
        $countries = Countries::all();
        return view('front.shop-checkout',compact('client','countries'));
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
