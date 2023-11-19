    @extends('front.layouts.main')
    @section('content')
    <div class="breadcrumb">
        <div class="container">
        <h2>Shop <span>Cart</span></h2>
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
        <div class="container">
        <div class="woocommerce">
        <form action="#" method="post">
        <table id="cart" class="shop_table cart">
        <thead>
        <tr>
        <th class="product-thumbnail">Image</th>
        <th class="product-name">Product</th>
        <th class="product-name">Size</th>
        <th class="product-price">Price</th>
        <th class="product-quantity">Quantity</th>
        <th class="product-subtotal">Total</th>
        <th class="product-remove">Remove</th>
        </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp


            @foreach($carts as $cart)

            @php $total += $cart->productPrice->price * $cart->count @endphp


        <tr  data-id="{{ $cart->id }}" class="cart_table_item">
        <td class="product-thumbnail">
        <a href="shop-detail.html"><img style="width: 71px;height:71px;" src="{{$cart->product->main_image}}" class="attachment-shop_thumbnail wp-post-image" alt="T_7_front" /></a>
        </td>
        
        <td class="product-name">
        <h6><a href="shop-detail.html">{{$cart->product->title}}</a></h6>
        </td>
        <td class="product-name" data-th="Price">
            <select >
                @foreach($cart->product->prices as $price)
                @if($cart->productPrice->id == $price->id)
                <option selected value="{{$price->id}}">{{$price->title}}</option>
                @else
                <option value="{{$price->id}}">{{$price->title}}</option>
                @endif
                @endforeach
            </select>
            </td>
        <td class="product-price" >
        <span class="amount"><i class="fa fa-gbp"></i> {{$cart->productPrice->price}}</span>
        </td>
        
        <td class="product-quantity" data-th="Quantity">
            {{-- <input type="number" value="{{ $cart->count }}" class="form-control quantity update-cart" /> --}}


        <div class="quantity">
        {{-- <input type="button" class="minus" value="-" /> --}}
        <input type="number" name="quantity" step="1" value="{{ $cart->count }}" min="1" title="Qty" class="input-text qty text  q update-cart"  />

        {{-- <input type="button" class="plus" value="+" /> --}}
        </div>
        </td>
        
        <td class="product-subtotal price">
        <span class="amount"><i class="fa fa-gbp"></i> {{$cart->productPrice->price * $cart->count}}</span>
        </td>
        
        <td class="product-remove" data-th="">
        <a href="#" class="remove" title="Remove this item">&times;</a>
        </td>
        </tr>
        @endforeach

        </tbody>
        </table>
        <input type="submit" class="button" name="update_cart" value="Update Cart">
        <input type="submit" class="button" name="continue" value="Continue Shopping">
        </form>
        <div class="cart-collaterals">
        <div class="coupon">
        <h3>Coupon</h3>
        <form action="#" method="post">
        <label for="coupon_code">Enter Coupon Code</label>
        <input name="coupon_code" class="input-text" id="coupon_code" value placeholder="Enter Code" />
        <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
        </form>
        </div>
        <div class="cart_totals">
        <h3>Cart Totals</h3>
        <table>
        <tbody>
        <tr class="cart-subtotal">
        <th>Cart Subtotal</th>
        <td><span class="amount"><i class="fa fa-gbp"></i> {{$total}}</span></span></td>
        </tr>
        <tr class="shipping">
        <th>Shipping</th>
        <td>Free Shipping<input type="hidden" name="shipping_method" id="shipping_method" value="free_shipping" /></td>
        </tr>
        <tr class="total">
        <th>Order Price Total</th>
        <td><strong><span class="amount"><i class="fa fa-gbp"></i> {{$total}}</span></span></strong></td>
        </tr>
        </tbody>
        </table>
        <a class="dt-sc-button medium type2 with-icon" href="shop-checkout.html"><i class="fa fa-shopping-cart"></i> <span> Proceed to Checkout </span> </a>
        </div>
        </div>
        </div>
        </div>
        <div class="dt-sc-hr-invisible-small"></div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">

  

    $(".update-cart,.minus,.plus").on('change',function (e) {

        e.preventDefault();

  

var ele = $(this);



$.ajax({

    url: '{{ route('update.cart') }}',

    method: "patch",

    data: {

        _token: '{{ csrf_token() }}', 

        id: ele.parents("tr").attr("data-id"), 

        quantity: ele.parents("td").find(".q").val()

    },

    success: function (response) {

        var newPrice = response.updatedPrice;
        ele.parents('td').find('.price').text(newPrice);

    }

});

});

  

  

  

</script>
        @endsection
