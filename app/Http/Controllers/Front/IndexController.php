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
use Carbon\Carbon;
use DB;

class IndexController extends Controller
{
   

    public function index()
    {
        // $category       = Category::with(['products' => function ($query) {
        //     $query->whereHas('orderproducts', function ($q) {
        //         $q->selectRaw('SUM(order_products.count)')->take(10);
        //     });
        // }])->where('published',1)->get();

        $category       = Category::where('published',1)->get();


        $categories = $category->filter(function ($row)  {
            return in_array(session()->get('country')->id, json_decode($row->country));
        });



        $results = DB::table('categories as c')
        ->leftJoin('products as p', 'c.id', '=', 'p.category_id')
        ->leftJoin('order_products as op', 'p.id', '=', 'op.product_id')
        ->whereIn('c.country', [session()->get('country')->id])
        ->groupBy('c.id', 'c.title_en', 'p.id', 'p.title')
        ->select('c.id as category_id', 'c.title_en as category_title', 'p.id as product_id', 'p.title as product_title', DB::raw('SUM(op.count) as total_orders'))
        ->orderBy('category_id')
        ->orderByDesc('total_orders')
        ->get();

return $results;
dd($results);

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

    //     $sliders         = Slider::where('published',1)->get();
    //     $allCategories   = Category::where('published',1)->get();
    //     $categories      = Category::whereHas('countries', function ($query) {
    //         $query->where('country_id', '=', session()->get('country')->id)->where('published',1);
    //     })->withCount(['products' => function ($query) {
    //     $query->where('is_active', 1)->whereHas('provider', function ($query) {
    //         $query->where('country', '=', session()->get('country')->id)->where('published',1);
    //     });
    // }])->get();
    //      $products = Product::where('is_active', 1)->whereHas('provider', function ($query) {
    //      $query->where('country',session()->get('country')->id);
    //       })->get();
    //       $ads = ProviderAd::where([['is_active',1],['expiry_date','>=', Carbon::today()]])->whereHas('provider', function ($query) {
    //         $query->where('country', '=', session()->get('country')->id)->where('published',1);
    //          })->latest()->limit('4')->get();
    //         //   dd($ads);

    //              $ofers_products = ProductPrice::where([['is_active',1],['offer_end_date','>=', Carbon::today()],['offer_price','!=', null]])->with('product')->whereHas('product',function($q){
    //                     $q->where([['approved_by_admin','1'],['is_active','1']]);
    //              })->get();
    //             //  dd($ofers_products);

    //             $recently_added = Product::where('is_active', 1)->whereHas('provider', function ($query) {
    //                 $query->where('country',session()->get('country')->id);
    //                  })->orderBy('id','DESC')->limit(3)->get();


                    // $top_selling = Product::select('products.*')
                    //     ->leftJoin('order_products', 'products.id', '=', 'order_products.product_id')->where('is_active', 1)->whereHas('provider', function ($query) {
                    //             $query->where('country',session()->get('country')->id);
                    //         })
                    //     ->groupBy('products.id')
                    //     ->orderByDesc(DB::raw('SUM(order_products.count)'))
                    //     ->limit(3)
                    //     ->get();


                    //     $top_rated = Product::select('products.*')->with('category','review','provider','prices')
                    //     ->leftJoin('products_reviews', 'products.id', '=', 'products_reviews.product_id')->where('is_active', 1)->whereHas('provider', function ($query) {
                    //             $query->where('country',session()->get('country')->id);
                    //         })
                    //     ->groupBy('products.id')
                    //     ->orderByDesc(DB::raw('SUM(products_reviews.rate)'))
                    //     ->limit(3)
                    //     ->get();

                        $top_selling=[];
                        $top_rated=[];


            //  $ofers_products = Product::whereHas('prices',function($q){
            //         $q->where([['is_active',1],['offer_end_date','>=', Carbon::today()],['offer_price','!=', null]]);
            //  })->get();
        //   dd($ofers_products);
        return view('front.index',compact('categories','lastProducts','orders'));
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

