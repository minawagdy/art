<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorit;
use Redirect;
use Laravel\Socialite\Facades\socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use reditrect;
use App\Models\Category;
use App\Models\Slider;
use App\Models\ProductPrice;
use App\Models\ProviderAd;
use App\Models\Provider;
use App\Models\Page;
use Carbon\Carbon;
use DB;
use Session;

class IndexController extends Controller
{
   

    public function index()
    {
       
$category = Category::with(['products' => function ($query) {
    $query->where('is_active', 1)
         ->where('status',1)
        ->with('images')
        ->with('orderProducts')
        ->select('products.*')
        ->leftJoin('providers', 'products.provider_id', '=', 'providers.id')
        ->where('providers.country', Session::get('country')->id)
        ->orderByDesc(DB::raw('(SELECT SUM(order_products.count) FROM order_products WHERE order_products.product_id = products.id)'))
        ->take(10);
}])
->where('published', 1)
->get();

$categories = $category->filter(function ($row)  {
            return in_array(session()->get('country')->id, json_decode($row->country));
        });

        $lastProducts = Product::whereHas('provider', function($q){
            $q->where('country', session()->get('country')->id)->where('published',1)->where('status',1);
        })->where('approved_by_admin',1)->where('is_active',1)->orderby('id','desc')->take(4)->get();

        $orders = Product::select('products.id', 'products.title as title')
        ->leftJoin('order_products', 'products.id', '=', 'order_products.product_id')
        ->where('is_active', 1)
        ->whereHas('provider', function ($query) {
            $query->where('country', session()->get('country')->id);
        })
        ->groupBy('products.id','products.title')
        ->orderByDesc(DB::raw('SUM(order_products.count)'))
        ->take(5)->get();

                        $top_selling=[];
                        $top_rated=[];

        $randomArtists = Provider::inRandomOrder()
                                ->where('published',1)
                                ->where('status',1)
                                ->where('country',session()->get('country')->id)
                                ->take(3)
                                ->get();

        $page=Page::find(1);

        return view('front.index',compact('categories','lastProducts','randomArtists','page'));
    }

    public function getCategory($category)
    {
        $category = 1;
        // $request->input('category');
        $products = Product::where('category_id', $category)->get();
        return response()->json(['products' => $products]);
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->input('categoryId');
        
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }

    public function toggle(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            // User is logged in
             $itemId = $request->input('item_id');

            // $wishlist = $user->wishlist;

            // // Check if the item exists in the wishlist
            $exists = Favorit::where('client_id',$user->id)->where('product_id',$itemId)->exists();

            if(!$exists) {
                Favorit::create([
                    'client_id' => $user->id,
                    'product_id'=> $itemId
                ]);
                 return response()->json(['message' => 'Item add to  wishlist']);

            }else{
                Favorit::where([
                    'client_id' => $user->id,
                    'product_id'=> $itemId
                ])->delete();
                   return response()->json(['message' => 'Item removed from wishlist']);

            }

        } else {

            // User is not logged in, return an error or login prompt
            return response()->json(['message' => 'Please login first']);
        }
    }

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(){
        try{
            $user     = Socialite::driver('google')->user();
            $finduser = User::where('google_id',$user->id)->first();
            if($finduser)
            {
                Auth::login($finduser);

            return redirect()->intended('/');
            }else{
              $newUser = User::Create([
                 'name'      => $user->name,
                 'email'     => $user->email,
                 'google_id' => $user->id,
                 'password'  => encrypt('123456789')
              ]);

              Auth::login($newUser);
              return reditrect()->intended('/');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function facebookLogin(){
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookCallback(){
        try{
            $user     = Socialite::driver('acebook')->user();
            $finduser = User::where('facebook_id',$user->id)->first();
            if($finduser)
            {
                Auth::login($finduser);

            return redirect()->intended('/');
            }else{
              $newUser = User::Create([
                 'name'      => $user->name,
                 'email'     => $user->email,
                 'facebook_id' => $user->id,
                 'password'  => encrypt('123456789')
              ]);

              Auth::login($newUser);
              return reditrect()->intended('/');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}

