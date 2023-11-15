<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProviderReview;
class ArtistController extends Controller
{
    public function index ($id){

        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);
        
         $artist = Provider::with('products')->find($id);
         $maxOrderedProduct = $artist->products()
        ->withCount('orderproducts')
        ->orderByDesc('orderproducts_count')
        ->first();

        return view ('front.artist',compact('artist','maxOrderedProduct'));
    }

   // Save Comment
   public function save_comment(Request $request){
    $comments = ProviderReview::where('provider_id',$request->post)->where('user_id',$request->user_id)->first();
    if(!$comments){
    $data=new \App\Models\ProviderReview;
    $data->provider_id=$request->post;
    $data->notes=$request->comment;
    $data->rate = $request->rate;
    $data->user_id=$request->user_id;
    $data->save();
    }else{

    $comments->provider_id = $request->post;
    $comments->notes       = $request->comment;
    $comments->rate       = $request->rate;
    $comments->user_id     = $request->user_id;

    $comments->save();
    }
    return response()->json([
        'bool'=>true
    ]);
}
}
