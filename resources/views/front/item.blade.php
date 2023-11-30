@extends('front.layouts.main')

@section('content')

<div class="breadcrumb">
    <div class="container">
    <h2>Gallery <span>Detail</span></h2>
    @if (Auth::check())
    <div class="user-summary">
    <div class="account-links">
    <a href="#">My Account</a>
    <a href="{{url('shop-checkout')}}">Checkout</a>
    </div>
    <div class="cart-count">
        <a  href="{{url('shopping-cart')}}">Shopping Bag: <span class="itemCount">0</span> items</a>
        <a href="#">(<span class="totalPrice">0</span>)</a>
    </div>
    </div>
    @endif
    </div>
    </div>
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h3> {{$product->title}} </h3>
    <p>{{$product->category->title_en}}</p>
    </div>
    {{-- <section id="secondary" class="secondary-sidebar secondary-has-left-sidebar">
        <aside class="widget widget_search">
        <div class="widgettitle sub-title">
        <h3>Have you Lost ?</h3>
        </div>
        <form method="post" novalidate="novalidate" id="searchform" action="route('search.')">
        <p class="input-text">
        <input class="input-field" type="email" name="mc_email" value required />
        <label class="input-label">
        <i class="fa fa-search icon"></i>
        <span class="input-label-content">Hunt</span>
        </label>
        <input type="submit" name="submit" class="submit" value="Submit" />
        </p>
        </form>
        <div id="ajax_subscribe_msg"></div>
        </aside>
        <aside class="widget widget_categories">
        <div class="widgettitle sub-title">
        <h3> Categories </h3>
        </div>
        <ul>
            @foreach ($categories as $category )
            <li class="cat-item"><a title="#" href="#">{{$category->title_en}}<span> {{$category->products_count}}</span></a></li>

            @endforeach
       
        </ul>
        </aside>
        <aside class="widget widget_popular_entries">
        <div class="widgettitle sub-title">
        <h3> Latest Gallery</h3>
        </div>
        <div class="recent-gallery-widget">
        <ul>
        <li>
        <a class="entry-thumb" href="#"><img alt="Enjoy Life with Family" src="images/blog-images/blog-img3.jpg"></a>
        <h5><a href="#"> Cowboy of Timberland </a></h5>
        <p>Vivamus ullamcorper, enim at varius molestie, nunc libero pulvinar sapien, quis fringilla purus mi vitae tellus.</p>
        </li>
        </ul>
        </div>
        </aside>
        <aside class="widget widget_tag_cloud">
        <div class="widgettitle sub-title">
        <h3> Tags </h3>
        </div>
        <div class="tagcloud type3">
        <a title="1 topic" href="#">Sketch</a>
        <a title="1 topic" href="#">Oil color</a>
        <a title="1 topic" href="#">Acrylic</a>
        <a title="1 topic" href="#">Sculpture</a>
        <a title="1 topic" href="#">Crayons</a>
        <a title="1 topic" href="#">Art</a>
        </div>
        </aside>
        </section> --}}
    <section id="primary" class="content-full-width">
    <article>
    <div class="dt-sc-one-column column first">
    <div class="recent-gallery-container">
    <ul class="recent-gallery">
        @foreach($product->images as $image)
    <li> <img style="width:1200px;height:500px;" src="{{$image->main_name}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt="image" /> </li>
    @endforeach
    </ul>
    <div id="bx-pager">
        @foreach($product->images as $image)
    <a href="#" data-slide-index="0"><img <img style="width:144p×;height:60px;" src="{{$image->main_name}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt="image" /></a>
    @endforeach
    </div>
    </div>
    </div>
    <div class="dt-sc-hr-invisible-small"> </div>
    <div class="dt-sc-two-third column first animate" data-animation="fadeInLeft" data-delay="100">
    <h3>{{$product->title}}</h3>
    {{$product->description}}
<div>
    @foreach($product->prices as $price)
    <button class="sizeButton" data-priceid="{{$price->id}}" data-productid="{{$product->id}}" data-price="@if($price->offer_end_date>=\Carbon\Carbon::now()->format('Y-m-d') && $price->offer_price!=null){{$price->offer_price}}@else {{$price->price}}@endif
        ">{{$price->title}}<br>
        @if($price->offer_end_date>=\Carbon\Carbon::now()->format('Y-m-d') && $price->offer_price!=null){{'Price:'}}<s> {{$price->price}}</s><br>{{'Offer Price:'}}{{$price->offer_price}}@else {{'Price:'}}{{$price->price}}@endif
    </button>

@endforeach

<!-- Add other buttons for different sizes as needed -->

<!-- Display area for the selected size and price -->
<div id="selectedSizePrice"></div>

<!-- Button to add the selected item to cart -->
<button id="addToCartBtn">Add to Cart</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Simulate click on the first size button to set it as selected by default
    $('.sizeButton:first').addClass('selected');

    // Show selected size and price when a button is clicked
    $('.sizeButton').click(function() {
        $('.sizeButton').removeClass('selected'); // Remove the selected class from all buttons
        $(this).addClass('selected'); // Add the selected class to the clicked button

        var selectedSize    = $(this).data('priceid');
        var selectedPrice   = $(this).data('price');
        var SelectProduct = $(this).data('productid');
        // $('#selectedSizePrice').text('Size: ' + selectedSize + ', Price: $' + selectedPrice.toFixed(2));
    });

    // Handle adding the selected item to cart when clicking the button
    $('#addToCartBtn').click(function() {
        var selectedSize = $('.sizeButton.selected').data('priceid');
        var selectedPrice = parseFloat($('.sizeButton.selected').data('price'));
        var SelectProduct = parseFloat($('.sizeButton.selected').data('productid'));

        // If no size is explicitly clicked, take the details from the first size button
        if (!selectedSize) {
            selectedSize = $('.sizeButton:first').data('priceid');
            selectedPrice = parseFloat($('.sizeButton:first').data('price'));
            SelectProduct = parseFloat($('.sizeButton.selected').data('productid'));

        }

        // AJAX call to send data to Laravel backend
        $.ajax({
            url: '/addToCart', // Your Laravel route to handle adding to the cart
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data: {
                size: selectedSize,
                price: selectedPrice,
                count:1,
                product:SelectProduct
                // Add other necessary data for cart entry
            },
            success: function(response) {
        // Check the response for success or error status
        if (response && response.success === true) {
            // Handle successful addition of the item to the cart
            console.log('Item added to cart with ID:', response.last_inserted_id);
            // Other actions with the response data
            updateCartInfo(); 

            alert('Item added to cart.');

        } else {
            // If the response contains an error message
            if (response && response.error === 'Item already exists in the cart') {
                // Show an alert for the specific error message
                alert('Item already exists in the cart.');
            }else {
            // If the response doesn't indicate success, handle it as an error
            console.error('Error adding item to cart: Unexpected response', response);
        }
    }
    },
    error: function(xhr) {
        // Check if the response status is 401 (Unauthorized) or if the item already exists in the cart
        if (xhr.status === 401) {
            // Show a confirmation dialog
            var confirmation = confirm('Please login first. Do you want to proceed to the login page?');

            if (confirmation) {
                // Redirect to the login page
                window.location.href = '/login'; // Replace with your login page URL
            } else {
                // User clicked cancel, perform any other action or display message
                console.log('Action canceled by the user.');
            }
        } else {
            // Handle other errors if needed
            console.error('Error adding item to cart:', xhr);
            alert.error('Error adding item to cart');
        }
    }
});
});
});

</script>

<style>
/* CSS to define the selected class */
.selected {
    background-color: yellow; /* Change this to the desired selected state color */
    /* Add other styles as needed */
}
</style>

</div>
    </div>
    <div class="dt-sc-one-third column animate" data-animation="fadeInRight" data-delay="100">
    <div class="dt-sc-project-details">
    <h5>Other Details</h5>
    <div class="enquiry-details">
    <p> <i class="fa fa-cab"></i> 121 King St, Melbourne VIC 3, Australia </p>
    <p><i class="fa fa-mortar-board"></i> Stephen Jones</p>
    <p><i class="fa fa-wrench"></i> Crayons, Sketch, Scissors</p>
    <p> <i class="fa fa-tags"></i> Arcrylic, Sculpture, Canvas</p>
    <p> <i class="fa fa-globe"></i> <a href="#"> envato.com </a> </p>
    </div>
    <h5>Social Sharing</h5>
    <ul class="type3 dt-sc-social-icons">
    <li class="twitter"><a href="#"> <i class="fa fa-twitter"></i> </a></li>
    <li class="facebook"><a href="#"> <i class="fa fa-facebook"></i> </a></li>
    <li class="google"><a href="#"> <i class="fa fa-google"></i> </a></li>
    <li class="dribbble"><a href="#"> <i class="fa fa-dribbble"></i> </a></li>
    </ul>
    </div>
    </div>
    <div class="dt-sc-post-pagination">
    <a class="dt-sc-button small type3 with-icon prev-post" href="{{url('item')}}{{'/'}}@if(@$previousItem->id!=null){{@$previousItem->id}} @else{{$product->id}} @endif"> <span> Previous Post </span> <i class="fa fa-hand-o-left"> </i> </a>
    <a class="dt-sc-button small type3 with-icon next-post" href="{{url('item')}}{{'/'}}@if(@$nextItem->id!=null){{@$nextItem->id}} @else{{$product->id}} @endif"><i class="fa fa-hand-o-right"> </i> <span> Next Post </span> </a>
    </div>
    </article>
    </section>
    <div class="dt-sc-hr-invisible-small"> </div>
    </div>
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h3> Related Art </h3>
    </div>
    </div>
    <div class="portfolio-fullwidth">
    <div class="portfolio-grid">
    <div class="dt-sc-portfolio-container isotope"> 
        @foreach ($productCategories as $productCategory )
    <div class="portfolio nature still-life dt-sc-one-fourth">
    <figure>
    <img src="{{asset(@$productCategory->images[0]->main_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title>
    <figcaption>
    <div class="portfolio-detail">
    <div class="views">
    <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="{{asset(@$productCategory->images[0]->main_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';"></a><span>{{count($productCategory->images)}}</span>
    </div>
    <div class="portfolio-title">
    <h5><a href="gallery-detail.html">{{$productCategory->title}}</a></h5>
    <p>Make Way</p>
    </div>
    </div>
    </figcaption>
    </figure>
    </div>
    @endforeach
    </div>
    </div>
    </div>
    @endsection