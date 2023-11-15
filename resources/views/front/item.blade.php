@extends('front.layouts.main')

@section('content')

<div class="breadcrumb">
    <div class="container">
    <h2>Gallery <span>Detail</span></h2>
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
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h3> {{$product->title}} </h3>
    <p>{{$product->description}}</p>
    </div>
    <section id="primary" class="content-full-width">
    <article>
    <div class="dt-sc-one-column column first">
    <div class="recent-gallery-container">
    <ul class="recent-gallery">
        @foreach($product->images as $image)
    <li> <img style="width: 1200p×;height:500px;" src="{{$image->main_name}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt="image" /> </li>
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
    <a class="dt-sc-button small type3 with-icon prev-post" href="#"> <span> Previous Post </span> <i class="fa fa-hand-o-left"> </i> </a>
    <a class="dt-sc-button small type3 with-icon next-post" href="#"><i class="fa fa-hand-o-right"> </i> <span> Next Post </span> </a>
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
    <img src="{{asset($productCategory->images[0]->main_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title>
    <figcaption>
    <div class="portfolio-detail">
    <div class="views">
    <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="{{asset($productCategory->images[0]->main_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';"></a><span>{{count($productCategory->images)}}</span>
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