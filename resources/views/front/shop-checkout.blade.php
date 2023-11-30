@extends('front.layouts.main')
@section('content')
<div class="breadcrumb">
    <div class="container">
    <h2>Shop <span>Checkout</span></h2>
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
    
    <div class="woocommerce">
    
    <form action="{{route('checkout.store')}}" method="post" class="checkout">
     @csrf
    <div class="col2-set" id="customer_details">
     
    <div class="col-12">
    <div class="woocommerce-shipping-fields">
    <h3>Shipping Address</h3>
    {{-- <p id="ship-to-different-address">
    <input id="ship-to-different-address-checkbox" class="input-checkbox" checked="checked" type="checkbox" name="ship_to_different_address" value="1" />
    <label for="ship-to-different-address-checkbox" class="checkbox"><span></span>Ship to Billing Address</label>
    </p> --}}
    

    <p class="form-row form-row-wide" id="shipping_company_field"><label for="shipping_company" class>Name</label><input type="text" class="input-text " name="shipping_company" id="shipping_company" placeholder value="{{$client->name}}" /></p>

    <div class="form-row form-row-wide address-field">
        <label>Address </label>
        <div class="selection-box">
        <select name="address" class="shop-dropdown">
            <option value="0">Select Address</option>
        @foreach ($client->address as $address )
        
        <option value="{{$address->id}}">{{($address->building_type!=null) ? $address->building_type : $address->street }}</option>

        @endforeach
        
    </select>
        </div>

        <h3>Add New Adress</h3>
        <p class="form-row form-row-first address-field" id="shipping_city_field">
            <label>Country</label>
            <select id="countrySelect" class="input-text " value  name="country" />
            <option value="">Select Country</option>
            @foreach ($countries as $country )
            
            <option value="{{$country->id}}">{{$country->name }}</option>
    
            @endforeach
            
        </select>
        </p>
        <p class="form-row form-row-last address-field" id="shipping_postcode_field">
        <label for="shipping_postcode" class>Government *</label>
        <select id="citySelect" type="text" class="input-text " name="government" id="shipping_postcode"/>
        <option value="">Select Government</option> <!-- Static option -->
    
        </select>
        </p>
        
        <p class="form-row form-row-first address-field" id="shipping_postcode_field">
            <label for="shipping_postcode" class>Zone *</label>
            <select id="areaSelect" type="text" class="input-text " name="zone" id="shipping_postcode"/>
            <option value="">Select Zone</option> <!-- Static option -->
        
            </select>
            </p>
            <p class="form-row form-row-last address-field" id="shipping_postcode_field">
            <label for="shipping_postcode" class>phone *</label>
            <input type="text" class="input-text " name="phone" id="shipping_postcode" placeholder="Postcode" /></p>

            <div class="row">
        <div class="col-md-4">
            <p class="input-text">
                <label for="shipping_address_1" class>Building Number</label>
            <input class="input-field" type="text"  name="building_number" title="Enter your Building Number" placeholder="Building Number *">
            </p>
            </div>
            <div class="col-md-4">
                <p class="input-text">
                    <label for="shipping_address_2" class>Floor Number</label>

                <input class="input-field error" type="text"  autocomplete="off" name="floor_number" title="Enter your Floor Number" placeholder="Floor Number *">
                </p>
                </div>
                <div class="col-md-4">
                    <p class="input-text">
                        <label for="shipping_address_3" class>Flat Number</label>

                    <input class="input-field" type="text" autocomplete="off" placeholder="Flat Number" title="Flat Number">
                    </p>
                    </div>
            </div>

                
    <p class="form-row form-row-wide address-field" id="shipping_address_1_field">
        <label for="shipping_address_1" class>Address</label>
        <input type="text" class="input-text " name="street" id="shipping_address_1" placeholder="Street Name" value />
    </p>
    {{-- <div class="form-row form-row-wide address-field validate-required">
        <label>Country </label>
        <div class="selection-box">
        <select name="billing_city" class="shop-dropdown">
        @foreach ($countries as $country )
        
        <option value="{{$country->id}}">{{$country->name }}</option>

        @endforeach
        
    </select>
        </div> --}}
        
    {{-- <p class="form-row form-row-wide address-field validate-state" id="shipping_state_field"><label for="shipping_state" class>County </label><input type="text" class="input-text " name=" shipping_state" placeholder="State / County" value id="shipping_state" /></p> --}}
   
        
  
    <div class="clear"></div>
    </div> 
    </div> 
    </div> 
    </div> 
    <div class="dt-sc-margin50"></div>
    <h3 id="order_review_heading">Order Review &amp; Payment</h3>
    <div id="order_review">
    <table class="shop_table cart">
    <thead>
    <tr>
    <th class="product-thumbnail">Image</th>
    <th class="product-name">Product</th>
    <th class="product-price">Price</th>
    <th class="product-quantity">Quantity</th>
    <th class="product-subtotal">Total</th>
    </tr>
    </thead>
    <tbody>
    <tr class="cart_table_item">
    
    <td class="product-thumbnail">
    <a href="shop-detail.html"><img src="{{asset('front/images/top-product1.jpg')}}" class="attachment-shop_thumbnail wp-post-image" alt="T_7_front" /></a>
    </td>
    
    <td class="product-name">
    <h6><a href="shop-detail.html">Secret To Creativity</a></h6>
    </td>
    
    <td class="product-price">
    <span class="amount"><i class="fa fa-gbp"></i> 150</span>
    </td>
    
    <td class="product-quantity">
    <div class="quantity">
    <input type="button" class="minus" value="-" />
    <input type="number" name="quantity" step="1" value="1" min="1" title="Qty" class="input-text qty text" />
    <input type="button" class="plus" value="+" />
    </div>
    </td>
    
    <td class="product-subtotal">
    <span class="amount"><i class="fa fa-gbp"></i> 150</span>
    </td>
    </tr>
    <tr class="cart_table_item">
    
    <td class="product-thumbnail">
    <a href="shop-detail.html"><img src="{{asset('front/images/top-product2.jpg')}}" class="attachment-shop_thumbnail wp-post-image" alt="T_7_front" /></a>
    </td>
    
    <td class="product-name">
    <h6><a href="shop-detail.html">Lonely in Rain</a></h6>
    </td>
    
    <td class="product-price">
    <span class="amount"><i class="fa fa-gbp"></i> 175</span>
    </td>
    
    <td class="product-quantity">
    <div class="quantity">
    <input type="button" class="minus" value="-" />
    <input type="number" name="quantity" step="1" value="1" min="1" title="Qty" class="input-text qty text" />
    <input type="button" class="plus" value="+" />
    </div>
    </td>
    
    <td class="product-subtotal">
    <span class="amount"><i class="fa fa-gbp"></i> 175</span>
    </td>
    </tr>
    </tbody>
    </table>
    
    <div class="cart-collaterals">
    <div class="coupon">
    <h3>Coupon</h3>
    <label for="coupon_code">Enter Coupon Code</label>
    <input name="coupon_code" class="input-text" id="coupon_code" value placeholder="Enter Code" />
    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
    </div>
    <div class="cart_totals">
    <h3>Cart Totals</h3>
    <table>
    <tbody>
    <tr class="cart-subtotal">
    <th>Cart Subtotal</th>
    <td><span class="amount"><i class="fa fa-gbp"></i> 375</span></td>
    </tr>
    <tr class="shipping">
    <th>Shipping</th>
    <td>Free Shipping<input type="hidden" name="shipping_method" id="shipping_method" value="free_shipping" /></td>
    </tr>
    <tr class="total">
    <th>Order Price Total</th>
    <td><strong><span class="amount"><i class="fa fa-gbp"></i> 375</span></strong></td>
    </tr>
    </tbody>
    </table>
    </div>
    </div> 
    
    <div id="payment">
    <ul class="payment_methods methods">
    <li class="payment_method_bacs">
    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text />
    <label for="payment_method_bacs"><span></span>Direct Bank Transfer </label>
    <div class="payment_box payment_method_bacs"><p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won&#8217;t be shipped until the funds have cleared in our account.</p> </div>
    </li>
    <li class="payment_method_cheque">
    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text />
    <label for="payment_method_cheque"><span></span>Cheque Payment </label>
    <div class="payment_box payment_method_cheque" style="display:none;"><p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p> </div>
    </li>
    <li class="payment_method_paypal">
    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal" />
    <label for="payment_method_paypal"><span></span>PayPal <img src="{{asset('front/images/paypal.png')}}" alt="PayPal" /></label>
    <div class="payment_box payment_method_paypal" style="display:none;"><p>Pay via PayPal; you can pay with your credit card if you don&#8217;t have a PayPal account</p> </div>
    </li>
    </ul>
    <div class="form-row place-order">
    <noscript>Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" /></noscript>
    <input type="hidden" name="_wpnonce" value="127d0e67e3" /><input type="hidden" name="_wp_http_referer" value />
    <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" />
    </div>
    <div class="clear"></div>
    </div> 
    </div> 
    </form> 
    </div> 
    </div>
    </section> 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#countrySelect').change(function() {
            var selectedCountry = $(this).val();

            // AJAX request to get cities based on the selected country
            $.ajax({
                url: '/get-cities/' + selectedCountry,
                method: 'GET',
                success: function(response) {
                    // Clear the city dropdown and populate with new cities
                    $('#citySelect').empty();
                    $('#citySelect').append('<option value="">Select Government</option>'); // Add static option for areas
                    $.each(response, function(key, value) {
                        $('#citySelect').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle errors here
                }
            });
        });
    });

    $(document).ready(function() {
        $('#citySelect').change(function() {
            var selectedCity = $(this).val();

            // AJAX request to get areas based on the selected city
            $.ajax({
                url: '/get-areas/' + selectedCity,
                method: 'GET',
                success: function(response) {
                    // Clear the area dropdown and populate with new areas
                    $('#areaSelect').empty();
                    $('#areaSelect').append('<option value="">Select Zone</option>'); // Add static option for areas
                    $.each(response, function(key, value) {
                        $('#areaSelect').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle errors here
                }
            });
        });
    });
</script>
    @endsection

