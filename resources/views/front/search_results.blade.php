
<div id="yourDiv" style="display: none;">

    <ul class="products isotope" >
@foreach ($products as $product ) 

<li class="product-wrapper dt-sc-one-fifth"> 

<div class="product-container">
<a href="{{url('item'.'/'.$product->id)}}l"><div class="product-thumb"> <img src="{{asset($product->images[0]->image_name)}}" alt="image" /> </div> </a>
<div class="product-title">
    {{-- <input class="price-cart" ="{{ @$product->prices[0]->id }}"> --}}

{{-- <a  class="type1 dt-sc-button add-to-cart" data-price-id ="{{ @$product->prices[0]->id }}" data-product-id="{{ $product->id }}"> <span class="fa fa-shopping-cart"></span> Add to Cart </a> --}}

{{-- <a href="#" class="type1 dt-sc-button"> <span class="fa fa-unlink"></span> Options </a> --}}
{{-- <p>You don't take a photograph, Just make it</p> --}}
</div> 
</div> 

<div class="product-details">
<h5> <a style="color: black;" href="{{url('item'.'/'.$product->id)}}"> {{$product->title}} {{$product->category->title_en}} </a> </h5>
<span style="color: black;" class="amount"> {{@$product->prices[0]->price}} </span>
</div> 
</li>
@endforeach
</ul>
</div>