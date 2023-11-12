@extends('front.layouts.main')

@section('content')

<style>
.slider {
    background-image: url({{asset('storage/'.$setting->main_image)}}) !important;
}
</style>
<section id="primary" class="content-full-width"> 
    <div class="dt-sc-hr-invisible-small"></div>
    <div class="fullwidth-section"> 
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h2 class="aligncenter"> BEST SELLERS</h2>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
    </div>
    </div>

    <div class="dt-sc-sorting-container">
    <a style="margin-top:10px;" data-filter="*" href="#" title="09" class="dt-sc-tooltip-top active-sort type1 dt-sc-button animate" data-animation="fadeIn" data-delay="100">All</a>
    @foreach ($categories as $category )
    <a style="margin-top:10px;" data-filter=".{{$category->id}}" href="#" title="{{$category->title_en}}" class="dt-sc-tooltip-top type1 dt-sc-button animate" data-animation="fadeIn" data-delay="200">{{$category->title_en}}</a>
    @endforeach
    </div>
    <div class="portfolio-fullwidth">
    <div class="portfolio-grid">
    <div class="dt-sc-portfolio-container isotope"> 
        @foreach($categories as $category)
        @foreach($category->products as $products)
      <div class= "portfolio {{$category->id}} still-life dt-sc-one-fourth isotope-item">
      
    <figure>
    <img src="{{asset(@$products->images[0]->image_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title>
    <figcaption>
    <div class="portfolio-detail">
        @foreach ($products->images as $images)
    <div class="views">
    <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="{{asset(@$images->image_name)}}"></a><span>{{count($products->images)}}</span>
    </div>
    @endforeach

    <div class="portfolio-title">
    <h5><a href="gallery-detail.html">{{$products->title}}</a></h5>
    <p>{{$products->description}}</p>
    </div>
    </div>
    </figcaption>
    </figure>
    </div>
    @endforeach
    @endforeach
    </div>
    </div>
    </div>
    </div>
    <div class="clear"></div>
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h2 class="aligncenter"> Latest Items </h2>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
    </div>
    </div>
    <div class="fullwidth-section">
        @foreach ($lastProducts as $key=>$lastProduct )
             <div class="blog-section">
    <article class="blog-entry  @if($key/2!=0) {{'type2'}} @endif">
    <div class="entry-thumb">
    <ul class="blog-slider">
        @foreach ($lastProduct->images as $images )
    <li> <img style="width: 760px;height:374px;" src="{{asset($images->image_name)}}" alt title> </li>
    @endforeach
    </ul>
    </div>
    <div class="entry-details">
    <div class="entry-title">
    <h3><a href="blog-detail.html">{{$lastProduct->title}}</a></h3>
    </div>
    <div class="entry-body">
    <p><b>{{$lastProduct->description}}</p>
    </div>
    <a class="type1 dt-sc-button small" href="gallery-detail.html">View Gallery<i class="fa fa-angle-right"></i></a>
    </div>
    </article>
    </div>
        @endforeach
   
    </div>
    </div>
    <div class="clear"></div>
    <div style="margin-top: 50px;" class="fullwidth-section">
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h2 class="aligncenter"> Artists </h2>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
    </div>
    </div>
    <div class="frame-grid">
    <div class="frame-thumb">
    <div class="frame-fullwidth">
    <div class="dt-sc-frame-container isotope"> 
        @foreach($randomArtists as $randomArtist)
        
    <div class="frame ceramic dt-sc-one-third">

    <figure>
   <img src="{{asset($randomArtist->profile_img)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title="{{$randomArtist->name}}">
    </figure>
    </div>
    
    @endforeach
    
    </div>
    </div>
    </div>
    <div class="frame-details">
    <div class="frame-content">
    <div id="frame-all" class="dt-frames">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
    </div>
    <div id="frame-steel" class="dt-frames hidden">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
    </div>
    <div id="frame-wooden" class="dt-frames hidden">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="frame-plastic" class="dt-frames hidden">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div id="frame-ceramic" class="dt-frames hidden">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
    </div>
    </div>
   
    </div>
    </div>
    </div>
    <div class="dt-sc-hr-invisible-small"></div>
    <div class="clear"></div>
    <div class="fullwidth-section">
    <div class="container">
    <div class="main-title animate" data-animation="pullDown" data-delay="100">
    <h2 class="aligncenter"> About Me </h2>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>
    </div>
    <div class="about-section">
    <div class="dt-sc-one-half column first">
    <img src="{{asset('front/images/about.png')}}" title alt>
    </div>
    <div class="dt-sc-one-half column">
    <h3 class="animate" data-animation="fadeInLeft" data-delay="200"> A Little Intro</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
    <h3 class="animate" data-animation="fadeInLeft" data-delay="300">My Exhibitions</h3>
    <p>Sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, Lorem ipsum dolor quis nostrud exercitation ullamco</p>
    <h3 class="animate" data-animation="fadeInLeft" data-delay="400">Newsletter</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
    <form method="post" class="mailchimp-form dt-sc-three-fourth" name="frmnewsletter" action="https://wedesignthemes.com/html/redart/default/php/subscribe.php">
    <p class="input-text">
    <input class="input-field" type="email" name="mc_email" value required />
    <label class="input-label">
    <i class="fa fa-envelope-o icon"></i>
    <span class="input-label-content">Mail</span>
    </label>
    <input type="submit" name="submit" class="submit" value="Subscribe" />
    </p>
    </form>
    <div id="ajax_subscribe_msg"></div>
    </div>
    </div>
    </div>
    </div>
    <div class="dt-sc-hr-invisible-small"></div>


  

    </section>
@endsection

