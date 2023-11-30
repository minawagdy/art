@extends('front.layouts.main')

@section('content')
<div class="breadcrumb">
    <div class="container">
    <h2>Shop</h2>
    @if (Auth::check())
    <div class="user-summary">
    <div class="account-links">
    <a href="#">My Account</a>
    <a href="#">Checkout</a>
    </div>
    <div class="cart-count">
        <a  href="#">Shopping Bag: <span class="itemCount">0</span> items</a>
        <a href="#">(<span class="totalPrice">0</span>)</a>
    </div>
    </div>
    @endif
    </div>
    </div>
<section id="primary" class="content-full-width">
<div class="container">
<div class="main-title animate" data-animation="pullDown" data-delay="100">
<h3> Shop </h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
</div>
</div>
<div class="fullwidth-section shop-grid">
<div class="sorting-products">
<div class="dt-sc-one-fifth column first">
<div class="categories">
<h5>Categories</h5>
<div class="selection-box">
<select id="category-select" class="shop-dropdown">
<option value="" selected>Choose your category</option>
@foreach ($categories as $category )
<option value="{{$category->id}}" class="fa fa-fire-extinguisher">{{$category->title_en}}</option>>
@endforeach
</select>
</div>
</div>
</div>
<div class="dt-sc-one-fifth column">
<div class="categories">
<h5>Sort By</h5>
<div class="selection-box">
<select class="shop-dropdown">
<option value="" selected>Sort by</option>
<option value="1" class="fa fa-mortar-board">Popular Artist</option>
<option value="2" class="fa fa-money">Best Seller</option>
<option value="3" class="fa fa-thumb-tack">Featured Art</option>
<option value="4" class="fa fa-child">New Artist</option>
</select>
</div>
</div>
</div>
<div class="dt-sc-one-fifth column">
<div class="categories">
<h5>Art Type</h5>
<div class="selection-box">
<select class="shop-dropdown">
<option value="" selected>Choose your type</option>
<option value="1" class="fa fa-flask">Acrylic</option>
<option value="2" class="fa fa-paint-brush">Oil Painting</option>
<option value="2" class="fa fa-scissors">Sculpture</option>
<option value="3" class="fa fa-tint">Water Painting</option>
</select>
</div>
</div>
</div>
<div class="dt-sc-one-fifth column">
<div class="categories">
<h5>Size &amp; Shape</h5>
<div class="selection-box">
<select class="shop-dropdown">
<option value="" selected>Choose your shape</option>
<option value="1" class="fa fa-picture-o">Landscape</option>
<option value="2" class="fa fa-barcode">Portrait</option>
<option value="3" class="fa fa-area-chart">Skew Framed</option>
</select>
</div>
</div>
</div>
<div class="dt-sc-one-fifth column">
<div class="categories">
<h5>Color</h5>
<div class="selection-box">
<select class="shop-dropdown">
<option value="" selected>Choose your color</option>
<option value="1" class="fa fa-bookmark red">Red</option>
<option value="2" class="fa fa-bookmark yellow">Yellow</option>
<option value="3" class="fa fa-bookmark blue">Blue</option>
<option value="4" class="fa fa-bookmark green">Green</option>
<option value="5" class="fa fa-bookmark black">Black</option>
</select>
</div>
</div>
</div>
</div>
<div id="search-results">
<ul class="products isotope" >
@foreach ($products as $product ) 

<li class="product-wrapper dt-sc-one-fifth"> 

<div class="product-container">
<a href="{{url('item'.'/'.$product->id)}}"><div class="product-thumb"> <img src="{{asset(@$product->images[0]->image_name)}}" alt="image" /> </div> </a>
<div class="product-title">
    {{-- <input class="price-cart" ="{{ @$product->prices[0]->id }}"> --}}

{{-- <a  class="type1 dt-sc-button add-to-cart" data-price-id ="{{ @$product->prices[0]->id }}" data-product-id="{{ $product->id }}"> <span class="fa fa-shopping-cart"></span> Add to Cart </a> --}}

{{-- <a href="#" class="type1 dt-sc-button"> <span class="fa fa-unlink"></span> Options </a> --}}
{{-- <p>You don't take a photograph, Just make it</p> --}}
</div> 
</div> 

<div class="product-details">
<h5> <a style="color: black;" href="{{url('item'.'/'.$product->id)}}"> {{$product->title}} {{@$product->category->title_en}} </a> </h5>
<span style="color: black;" class="amount"> {{@$product->prices[0]->price}} </span>
</div> 
</li>
@endforeach
</ul>
</div>
<div class="container">
<div class="dt-sc-post-pagination">
<a class="dt-sc-button small type3 with-icon prev-post" href="#"> <span> Previous </span> <i class="fa fa-hand-o-left"> </i> </a>
<a class="dt-sc-button small type3 with-icon next-post" href="#"><i class="fa fa-hand-o-right"> </i> <span> Next </span> </a>
</div>
</div>
</div>
</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
    $('.add-to-cart').click(function (event) {
        event.preventDefault();
        var product_id = $(this).data('product-id');
        var price_id   = $(this).data('price-id');
        var count      = 1; 
        var client_id  = 1;
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{ route('cart.add') }}",
            method: 'POST',
            
            data: {
                product_id : product_id,
                count      : count,
                price_id   : price_id,
                client_id  : client_id
            },
            success: function (response) {
                alert(response.message);
                var shoppingBagCount = parseInt($('#shopping-bag-count').text());
                    $('#shopping-bag-count').text(shoppingBagCount + 1);
                    var updatedCount = response.shoppingBagCount;
                  $('#shopping-bag-count').text(updatedCount);

                  var totalPrice = response.totalPrice;
                    $('#shopping-bag-sum').text(totalPrice); //
                // Optionally, update the cart UI or perform any other actions
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
    </script>

<script>
    $(document).ready(function() {
        $('#category-select').change(function() {
            var categoryId = $(this).val();

            // Reload the JavaScript file
            $.getScript("http://localhost:8000/front/js/jquery.isotope.min.js", function() {
                // Make an Ajax request to fetch search results based on the selected category
                $.ajax({
                    url: "{{ route('search.by.category') }}",
                    method: 'GET',
                    data: { category_id: categoryId },
                    success: function(response) {
                        $('#search-results').html(response); // Update the content with fetched data
                        $('#yourDiv').show(); // Show the div after the script is reloaded and search results are updated
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Handle errors
                    }
                });
            });
        });
    });
</script>