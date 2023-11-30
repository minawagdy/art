    @extends('front.layouts.main')
    @section('content')
    <div class="breadcrumb">
        <div class="container">
        <h2>Shop <span>Cart</span></h2>
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
        <td class="product-name" data-th="Price"">
            <select class="selectOption">
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
        <span id="oneprce{{$cart->id}}" class="amount">{{$cart->productPrice->price}}</span>
        </td>
        
        <td class="product-quantity" data-th="Quantity">
            {{-- <input type="number" value="{{ $cart->count }}" class="form-control quantity update-cart" /> --}}


        <div class="quantity">
        {{-- <input type="button" class="minus" value="-" /> --}}
        <input type="number" name="quantity" step="1" value="{{ $cart->count }}" min="1" title="Qty" class="input-text qty text  q update-cart"  />

        {{-- <input type="button" class="plus" value="+" /> --}}
        </div>
        </td>
        
        <td class="product-subtotal" >
         <p id="prce{{$cart->id}}">{{$cart->productPrice->price * $cart->count}}</p>
        </td>
      
        <td class="product-remove" data-th="">
        <a href="#" class="remove btn-sm remove-from-cart" title="Remove this item">&times;</a>
        </td>
        </tr>
        @endforeach

        </tbody>
        </table>
        {{-- <input type="submit" class="button" name="update_cart" value="Update Cart"> --}}
        
        <a href="{{url('shop')}}" class="button">Continue Shopping</a>
        </form>
{{-- <div id="couponMessage"></div> --}}
        <div class="cart-collaterals">
        <div class="coupon">
        {{-- <h3>Coupon</h3>
        <!-- <form action="#" method="post"> -->
        <form id="applyCouponForm">
        <label for="coupon_code">Enter Coupon Code</label>
        <input name="coupon_code" class="input-text" id="couponCode" value placeholder="Enter Code" />
        <input type="submit" value="Apply Coupon" name="apply_coupon" id="applyCouponBtn" class="button">
        </form> --}}
        </div>
        <div class="cart_totals">
        <h3>Cart Totals</h3>
        <table>
        <tbody>
        <tr class="cart-subtotal">
        <th>Cart Subtotal</th>
        <td class="totalPrice"><span class="amount"><i class="fa fa-gbp"></i></span></span></td>
        </tr>
        <tr class="shipping">
        <th>Shipping</th>
        <td>Free Shipping<input type="hidden" name="shipping_method" id="shipping_method" value="free_shipping" /></td>
        </tr>
        <tr class="total">
        <th>Order Price Total</th>
        <td class="totalPrice"><strong><span class="amount"><i class="fa fa-gbp"></i> </span></span></strong></td>

        
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

  

    $(".update-cart,.minus,.plus").on('keyup',function (e) {

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
                var id = ele.parents("tr").attr("data-id");
               $("#prce"+id ).text(newPrice);
               updateCartInfo(); 

               

            }

        });

        });

        $(".remove-from-cart").click(function (e) {

            e.preventDefault();



            var ele = $(this);



            if(confirm("Are you sure want to remove?")) {

                $.ajax({

                    url: '{{ route('remove.from.cart') }}',

                    method: "DELETE",

                    data: {

                        _token: '{{ csrf_token() }}', 

                        id: ele.parents("tr").attr("data-id")

                    },

                    success: function (response) {

                        ele.parents("tr").remove();
                        updateCartInfo(); 


                    }

                });

            }

            });

            $(document).ready(function() {
            
            $('.selectOption').change(function() {
                
                var ele = $(this);

            var selectedOption = $(this).val();
        // AJAX request to fetch text based on the selected option
        $('.q').val(1);

            $.ajax({
                url: '/fetch-text',
                method: 'GET',
                data: {
                    option: selectedOption
                },
                success: function(response) {
                    // Update the text on the page with the fetched data
                    var text = response.text;
                    var id = ele.parents("tr").attr("data-id");
                   $("#oneprce"+id ).text(text);
                   var newPrice = response.updatedPrice;
                  $("#prce"+id ).text(newPrice);
                  updateCartInfo(); 

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle errors here
                }
            });
        });
    });  

    $(document).ready(function() {
        $('#applyCouponForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            var couponCode = $('#couponCode').val();

            $.ajax({
                url: '{{ route('apply.coupon') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon_code: couponCode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#couponMessage').text(response.message);
                        // Update UI with discount details if needed
                    } else {
                        $('#couponMessage').text(response.message);
                    }
                },
                error: function(error) {
                    console.error('Error applying coupon:', error);
                }
            });
        });
    });
    
  

</script>
        @endsection

