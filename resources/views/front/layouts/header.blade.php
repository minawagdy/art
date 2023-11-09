@include('front.layouts.head')
<body>
    <div class="loader-wrapper">
    <div id="large-header" class="large-header">
    <h1 class="loader-title"><span>Red</span> Art</h1>
    </div>
    </div>
    
    <div class="wrapper">
    <div class="inner-wrapper">
    <div id="header-wrapper" class="dt-sticky-menu"> 
    <div id="header" class="header">
    <div class="container menu-container">
    <a class="logo" href="index-2.html"><img alt="Logo" src="{{asset('storage/'.$setting->logo)}}"></a>
    <a href="#" class="menu-trigger">
    <span></span>
    </a>
    </div>
    </div>
    <nav id="main-menu">
    <div id="dt-menu-toggle" class="dt-menu-toggle">
    Menu
    <span class="dt-menu-toggle-icon"></span>
    </div>
    <ul class="menu type1">
    <li class="current_page_item menu-item-simple-parent"><a href="index-2.html">Home <span class="fa fa-home"></span></a>
    <ul class="sub-menu">
    <li class="current_page_item"><a href="http://www.wedesignthemes.com/html/redart/default">Default</a></li>
    <li><a href="http://www.wedesignthemes.com/html/redart/menu-overlay">Menu Overlay</a></li>
    <li><a href="http://www.wedesignthemes.com/html/redart/slide-bar">Slide Bar</a></li>
    <li><a href="http://www.wedesignthemes.com/html/redart/slider-over-menu">Slider Over Menu</a></li>
    </ul>
    <a class="dt-menu-expand">+</a>
    </li>
    <li class="menu-item-simple-parent">
    <a href="about.html">About us <span class="fa fa-user-secret"></span></a>
    </li>
    <li class="menu-item-simple-parent"><a href="gallery.html">Gallery <span class="fa fa-camera-retro"></span></a>
    <ul class="sub-menu">
    <li><a href="gallery-detail.html">Gallery detail</a></li>
    <li><a href="gallery-detail-with-lhs.html">Gallery-detail-left-sidebar</a></li>
    <li><a href="gallery-detail-with-rhs.html">Gallery-detail-right-sidebar</a></li>
    </ul>
    <a class="dt-menu-expand">+</a>
    </li>
    <li class="menu-item-simple-parent"><a href="shop.html">Shop <span class="fa fa-cart-plus"></span></a>
    <ul class="sub-menu">
    <li><a href="shop-detail.html">Shop Detail</a></li>
    <li><a href="shop-cart.html">Cart Page</a></li>
    <li><a href="shop-checkout.html">Checkout Page</a></li>
    </ul>
    <a class="dt-menu-expand">+</a>
    </li>
    <li class="menu-item-simple-parent"><a href="blog.html">Blog <span class="fa fa-pencil-square-o"></span></a>
    <ul class="sub-menu">
    <li><a href="blog-detail.html">Blog detail</a></li>
    <li><a href="blog-detail-with-lhs.html">Blog-detail-left-sidebar</a></li>
    <li><a href="blog-detail-with-rhs.html">Blog-detail-right-sidebar</a></li>
    </ul>
    <a class="dt-menu-expand">+</a>
    </li>
    <li class="menu-item-simple-parent">
    <a href="contact.html">contact<span class="fa fa-map-marker"></span></a>
    </li>
    <li class="menu-item-simple-parent">
    <a href="progressbar.html">shortcodes <span class="fa fa-paint-brush"></span></a>
    <ul class="sub-menu">
    <li><a href="progressbar.html"> Progress-bar </a></li>
    <li><a href="buttons.html"> Buttons Page </a></li>
    <li><a href="tabs.html"> tabs-accordions </a></li>
    <li><a href="typography.html"> typography </a></li>
    <li><a href="columns.html"> columns </a></li>
    </ul>
    <a class="dt-menu-expand">+</a>
    </li>
    </ul> 
    </nav> 
    </div>
    <div class="slider-container">
    <div class="slider fullwidth-section parallax"></div>
    </div>
    <div id="main">