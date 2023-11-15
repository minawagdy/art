@extends('front.layouts.main')

@section('content')

<div class="breadcrumb">
<div class="container">
<h2>Gallery <span>Art</span></h2>
<div class="user-summary">
<div class="account-links">
<a href="#">My Account</a>
<a href="#">Checkout</a>
</div>
<div class="cart-count">
<a href="#">Shopping Bag: 0 items</a>
<a href="#">($0.00)</a>
</div>
</div>
</div>
</div>
<section id="primary" class="content-full-width"> 
<div class="fullwidth-section"> 
<div class="container">
<div class="main-title animate" data-animation="pullDown" data-delay="100">
<h3> Gallery </h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
</div>
</div>
<div class="dt-sc-sorting-container">
    <a style="margin-top:10px;" data-filter="*" href="#" title="09" class="dt-sc-tooltip-top active-sort type1 dt-sc-button animate" data-animation="fadeIn" data-delay="100">All</a>
    @foreach ($categories as $category )
    <a style="margin-top:10px;" data-filter=".{{$category->id}}" href="#" title="{{$category->title_en}}" class="dt-sc-tooltip-top type1 dt-sc-button animate" data-animation="fadeIn" data-delay="200">{{$category->title_en}}</a>
    @endforeach
    </div>
    <div class="portfolio-fullwidth">
    <div class="portfolio-grid" >
    <div class="dt-sc-portfolio-container isotope" id="items_container" > 
        {{-- @foreach($categories as $category) --}}
        @foreach($products as $product)
      <div class= "portfolio {{$product->category_id}} still-life dt-sc-one-fourth isotope-item">
      
    <figure>
    <img src="{{asset(@$product->images[0]->image_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title>
    <figcaption>
    <div class="portfolio-detail">
    <div class="views">
    <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="{{asset(@$product->images[0]->image_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';"></a><span>{{count($product->images)}}</span>
    </div>
    <div class="portfolio-title">
    <h5><a href="gallery-detail.html">{{$product->title}}</a></h5>
    <p>{{$product->description}}</p>
    </div>
    </div>
    </figcaption>
    </figure>
    </div>
    @endforeach
  
        <figure>
        <img src="/front/images/portfolio-images/img-1.jpg" alt title>
        <figcaption>
        <div class="portfolio-detail">
        <div class="views">
        <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="/front/images/portfolio-images/img-1.jpg"></a><span>3</span>
        </div>
        <div class="portfolio-title">
        <h5><a href="gallery-detail.html">Proposing Love</a></h5>
        <p>Sample text here looks good</p>
        </div>
        </div>
        </figcaption>
        </figure>
        </div>
    {{-- @endforeach --}}
    <span id="items_container">
    </span>
 </div>
    </div>
    </div>
    </div>
   
   
<div class="aligncenter">
{{-- <a href="#" class="loadmore dt-sc-button medium type3 with-icon"><i class="fa fa-picture-o"></i> <span> load more </span> </a> --}}
{{-- <button id="load_more_button" data-page="{{ $products->currentPage() + 1 }}"
    class="loadmore dt-sc-button medium type3 with-icon"></i> <span> load more </span>
</button> --}}
<button id="load_more_button" data-page="{{ $products->currentPage() + 1 }}" class="loadmore dt-sc-button medium type3 with-icon"><i class="fa fa-paint-brush"></i><span> More Art </span></button>
</div>
<div class="dt-sc-hr-invisible-small"></div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    var start = 5;

    $('#load_more_button').click(function() {
        $.ajax({
            url: "{{ route('load.more') }}",
            method: "GET",
            data: {
                start: start
            },
            dataType: "json",
            beforeSend: function() {
                $('#load_more_button').html('Loading...');
                $('#load_more_button').attr('disabled', true);
            },
            success: function(data) {
                if (data.data.length > 0) {
                    var html = '';
                    for (var i = 0; i < data.data.length; i++) {
                        html += `<div class="portfolio nature still-life dt-sc-one-fourth">
<figure>
<img src="/front/images/portfolio-images/img-1.jpg" alt title>
<figcaption>
<div class="portfolio-detail">
<div class="views">
<a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="/front/images/portfolio-images/img-1.jpg"></a><span>3</span>
</div>
<div class="portfolio-title">
<h5><a href="gallery-detail.html">`+ data.data[i].title +`</a></h5>
<p>`+ data.data[i].title +`</p>
</div>
</div>
</figcaption>
</figure>
</div>`;
                    }
                    //console.log(html);
                    //append data  without fade in effect
                    //$('#items_container').append(html);

                    //append data with fade in effect
                    $('#items_container').append($(html).hide().fadeIn(1000));
                    $('#load_more_button').html('<i class="fa fa-paint-brush"></i><span> More Art </span>');
                    $('#load_more_button').attr('disabled', false);
                    start = data.next;
                } else {
                    $('#load_more_button').html('No More Data Available');
                    $('#load_more_button').attr('disabled', true);
                }
            }
        });
    });
});
</script>
@endsection

