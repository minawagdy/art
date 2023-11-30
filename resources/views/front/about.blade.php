@extends('front.layouts.main')

@section('content')

<div class="breadcrumb">
<div class="container">
<h2>about us</h2>
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
    <h3> {{$page->title_en}} </h3>
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
    </div>
    <div class="dt-sc-service-content">
   {!!$page->description_en!!}
    </div>
    <div class="dt-sc-hr-invisible"></div>
    <div class="service-grid">
    {{-- <div class="dt-sc-one-half column first animate" data-animation="fadeInDown" data-delay="100">
    <img src="{{asset('front/images/about-img.png')}}" alt title>
    </div> --}}
    
    </div>
    </div>
    </section>

@endsection