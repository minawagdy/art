<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Countries;
use App\Models\ProductPrice;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Provider;
use App\Http\Controllers\Administrator;
use Session;
use Illuminate\Support\Facades\DB;
class Products extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getIndex(Request $request)
    {
        // $request->provider = '53';
        // $request->approvement = '0';
               $products = \App\Models\Product::with(['provider','images','category']);



                if($request->title){
                    $products = $products->where(function ($query) use ($request) {

                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }



                if($request->provider){
                     $products->where('provider_id',$request->provider);
                }

                if($request->approvement != NULL){

                     $products->where('approved_by_admin','=',$request->approvement);
                }


                $products->whereHas('provider', function ($q) {
                    $q->where('country', '=', session()->get('country')->id);
                });
               $products = $products->paginate(9);
            $products->each(function ($row) {
                $order_count = \App\Models\OrderProduct::whereHas('product', function ($query) use ($row) {
                })->where('product_id',$row->id)->count();
                $row->orders = $order_count;
		    });

         $totalcount = \App\Models\Product::with(['images','category']);
         if($request->title){
                    $totalcount = $totalcount->where(function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->title . '%');
                        $query->orWhere('title_ar', 'like', '%' . $request->title . '%');
                    });
                }
         $totalcount=$totalcount->count();
        //  $pending_product =$products->where('is_active','0');
        $pending_product =Product::where('approved_by_admin','0')->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country')->id);
            })->paginate(9);
            // $providers = Provider::where('published','1')->get();
            $providers = Provider::where('country', session()->get('country')->id)->get();

        //    dd($pending_product->total());
        // dd($products);
       return view('admin.products.products')->with(["totalcount"=>$totalcount,"products"=>$products,'pendings'=>$pending_product,'providers'=>$providers]);

    }

    public function getCategory()
{
    $category    = Category::all();
    $country_id  = Session::get('country')->id;

    $categories = $category->filter(function ($row) use ($country_id) {
        return in_array($country_id, json_decode($row->country));
    });
        return response()->json($categories);
}

public function getSubCategory($category_id)
{
    $subcategories = SubCategory::where('category_id', $category_id)->get();
    return response()->json($subcategories);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });
        $providers = Provider::where([['status','1'],['country', '=', session()->get('country')->id]])->get();
        return view('admin.products.create_product',compact('categories','providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        //  dd($request->all());
        // if($request->has('arr')){
        //         dd($request->arr);
        // }
        // dd('no');
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:25',
            'title_ar' => 'required|string|max:25',
            'description' => 'required|string|max:100',
            'description_ar' => 'required|string|max:100',
        //    'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'subcategory_id' => 'required|exists:App\Models\SubCategory,id',
            'prepare_time' => 'required|numeric|min:0',
             'images' => 'max:5',
            //  'main_image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
            // 'quantity' =>'required|numeric|min:0',
            // 'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id',

        ]);

        $request->merge(['is_active' => 1,
                        'approved_by_admin'=>'1',
                        ]);
        $data = $request->except(['images','main_image','prices']);
        DB::beginTransaction();

        if ($row = \App\Models\Product::create($data)) {
            // images
            if ($request->images) {
                        foreach($request->images as $i){

                            $imageName = time().'-'.$i->getClientOriginalName();
                        $i->move(public_path('/storage/product_images'), $imageName);
                        //$product->images()->delete();
                        $image = $row->images()->create(['title' => $request->input('title')]);
                        $image->image_name = $imageName;
                        $image->save();
                    }
                }
            // end images

            if($request->has('prices')){
            //  dd($request->prices);
                    foreach($request->prices as $p){
                        if($p['price']){
                        $product_price = new ProductPrice();
                        $product_price->product_id = $row->id;
                        $product_price->price = $p['price'];
                        $product_price->offer_price = $p['offer_price'];
                        $product_price->offer_end_date = $p['offer_end_date'];
                        $product_price->title = $p['title'];
                        $product_price->is_active = $p['is_active'] ?? 0;
                        $product_price->title_ar = $p['title_ar'];
                        $product_price->save();
                    }
                    }
                }


            DB::commit();

        // $row->images = $row->images;
        // \App\Models\ProductStocks::create(['product_id'=>$row->id,'quantity'=>$row->quantity]);
            session() -> flash('success', trans('added successfully'));

             } else{
                DB::rollback();

                session() -> flash('Error', trans('Error'));
             }
            return redirect('admin/products');

        }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        $product = \App\Models\Product::with(['category','sub_category','images','review','offers','stock'
        // => function ($query) use($id) {
        //     $query->where('product_id',$id);
        //  }
         ])->where('id',$id)->first();
         $reviews = \App\Models\ProductReview::with(['customer'])->where('product_id',$id)->get();
        return view('admin.products.product_details')->with(['product'=>$product,'reviews'=>$reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $product = \App\Models\Product::with('images')->findOrFail($id);
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });
            $providers = Provider::where([['status','1'],['country', '=', session()->get('country')->id]])->get();

        return view('admin.products.product_edit',compact('product','categories','providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyEdit(Request $request, $productId)
    {
        //  dd($request->all());
        $request->validate([
            // 'title' => 'unique:categories,title,'.$category->id,
            // 'title_ar' => 'unique:categories,title_ar,'.$category->id,
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'title' => 'string|max:25',
            'title_ar' => 'string|max:25',
            'description' => 'string|max:100',
            'description_ar' => 'string|max:100',
            // 'category_id' => 'exists:App\Models\Category,id,',
            'prepare_time' => 'numeric|min:0,',
            // 'images' => 'max:5',
            // 'sub_category_id' =>'numeric|min:0|exists:App\Models\SubCategory,id,',
        ]);
        $product = \App\Models\Product::where('id',$productId)->first();

$data = $request->except(['images','prices','main_image']);
if ($request -> has('main_image')) {
    $m_image = $this -> saveImages($request -> main_image, public_path('/storage/product_images'));
    $data['main_image'] = $m_image;
}
        DB::beginTransaction();
        if($product->update($data)){


        if ($request->images) {

            foreach($request->images as $i){
                // dd($i->getClientOriginalName());

            $imageName = time().'-'.$i->getClientOriginalName();

            $i->move(public_path('/storage/product_images'), $imageName);
            //$product->images()->delete();
            $image = $product->images()->create(['title' => $request->input('title')]);
            $image->image_name = $imageName;
             $image->save();
        }

        // dd($product->images);
    }



    if($request->has('prices')){
        // dd($request->prices);
         ProductPrice::where('product_id',$productId)->delete();

                foreach($request->prices as $p){
                    if($p['price']){
                    $product_price = new ProductPrice();
                    $product_price->product_id = $product->id;
                    $product_price->price = $p['price'];
                    $product_price->offer_price = $p['offer_price'];
                    $product_price->offer_end_date = $p['offer_end_date'];
                    $product_price->title = $p['title'];
                    $product_price->is_active = $p['is_active'] ?? 0;
                    $product_price->title_ar = $p['title_ar'];
                    $product_price->save();
                }
                }
            }


    $product->images = $product->images;


    DB::commit();
    session() -> flash('success', trans('Product updated successfully.'));
        }else{

            DB::rollback();

            session() -> flash('Error', trans('Error'));
         }
        return redirect()->back();

        }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anyDelete($id)
    {
       $product = \App\Models\Product::where('id',$id)->first();
       $product->images()->delete();
    //    $product->stock()->delete();
       $product->delete();
        return redirect()->back()
        ->with('success','Product Deleted successfully.');
    }

    public function anyReviewRemove($id)
    {
        \App\Models\ProductReview::where('id',$id)->delete();
        return redirect()->back()
        ->with('success','Review deleted successfully.');
    }
    public function getDeleteImage($id) {
        //  dd($id);
        $row = \App\Models\Image::whereImageName($id)->orWhere("id", "=", $id)->first();
        if ($row){
            $row->delete();

        return redirect()->back()
            ->with('success','Deleted successfully.');
    }
}

    public function anySubCategory(Request $request)
    {   $category_id = $request->category_id;
        $sub_category = \App\Models\SubCategory::where('category_id',$category_id)->get();
        return response()->json($sub_category);
    }

    //  update approved_by_admin by admin
    public function updateStatus($id){

        $row = Product::find($id);
        if ($row->approved_by_admin == 0) {
            $row->approved_by_admin = 1;
        } else {
            $row->approved_by_admin = 0;
        }
        $row->save();

        session() -> flash('success', trans('status updated successfully'));
        return redirect()->back();

    }
}
