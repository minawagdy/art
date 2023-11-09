<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
   
    public function index()
    {
        $products = Product::with(['provider','images','category'])->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country'));
        })->get();
        $totalcount =   Product::with(['provider','images','category'])->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country'));
        })->count();
        $pending_product =Product::where('approved_by_admin','0')->whereHas('provider', function ($q) {
            $q->where('country', '=', session()->get('country'));
            })->count();
    
        return view('admin.product.index',compact('products','totalcount','pending_product'));
    }

    public function updateCheckbox(Request $request)
    {
        $checkboxValue = $request->input('checkboxValue');
        $ctegoryId = $request->input('ctegoryId');

        // Update the database based on the checkbox value
        $this->categoryRepository->updateCheckboxState($ctegoryId, $checkboxValue);

        return response()->json(['success' => true]);
    }
    public function create()
    {
        $category    = Category::all();
        $country_id  = Session::get('country')->id;

        $categories = $category->filter(function ($row) use ($country_id) {
            return in_array($country_id, json_decode($row->country));
        });

        $providers = Provider::where([['status','1'],['country', '=', session()->get('country')]])->get();
        return view('admin.product.create',compact('categories','providers'));
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
    $subcategories = Subcategory::where('category_id', $category_id)->get();
    return response()->json($subcategories);
}

    public function store(productRequest $request)
    {

        $validatedData = $request->validated();

        $validator = Validator::make($request->all(), $validatedData);
        $request->merge(['is_active' => 1,
        'approved_by_admin'=>'1',
        ]);
        if ($row = Product::create($request->except(["images", "prices"]))) {
            if ($request->file('images')) {
                foreach($request->images as $i){

                    $imageName = time() . '.' . $i->extension();
                    $i->move(public_path('/storage/product_images'), $imageName);
                    //$product->images()->delete();
                    $image = $row->images()->create(['title' => $request->input('title')]);
                    $image->image_name = $imageName;
                    $image->save();
                }

            }

            if($request->has('prices')){
                // dd($request->prices);
                        foreach($request->prices as $p){
                            if($p['price']){
                            $product_price = new ProductPrice();
                            $product_price->product_id = $row->id;
                            $product_price->price = $p['price'];
                            $product_price->title = $p['title'];
                            $product_price->title_ar = $p['title_ar'];
                            $product_price->save();
                        }
                        }
        }
    }
    return  redirect()->route('products');

    }


    public function show(Request $request): JsonResponse
    {
        $categoryId = $request->route('id');

        return response()->json([
            'data' => $this->categoryRepository->getAllCategoryById($ctegoryId)
        ]);
    }
    public function edit($productId)
    {
      return  $this->productRepository->editProduct($productId);

    }
    public function update(productRequest $request)
    {
    
        $productId = $request->route('id');
        return $this->productRepository->updateProduct($productId, $request);

    }

    public function destroy($id)
    {
        return $this->productRepository->deleteProduct($id);

    }
}
