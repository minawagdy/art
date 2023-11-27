<footer id="footer" class="animate" data-animation="fadeIn" data-delay="100">
    <div class="container">
    <div class="copyright">
    <ul class="footer-links">
    <li><a href="#">Contact us</a></li>
    <li><a href="#">Privacy policy</a></li>
    <li><a href="#">Terms of use</a></li>
    <li><a href="#">Faq</a></li>
    </ul>
    <ul class="payment-options">
    <li><a href="#" class="fa fa-cc-amex"></a></li>
    <li><a href="#" class="fa fa-cc-mastercard"></a></li>
    <li><a href="#" class="fa fa-cc-visa"></a></li>
    <li><a href="#" class="fa fa-cc-discover"></a></li>
    <li><a href="#" class="fa fa-cc-paypal"></a></li>
    </ul>
    <p>© 2015 <a href="#">RED ART</a>. All rights reserved.</p>
    </div>
    </div>
    </footer>
    </div>
    </div>
    </div>
    
    <script src="{{asset('front/js/jquery-1.11.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/jquery.inview.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/jquery.viewport.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('front/js/jsplugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/jquery.prettyPhoto.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/jquery.tipTip.minified.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.bxslider.min.js')}}"></script>
    <script src="{{asset('front/js/controlpanel.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/js/custom.js')}}"></script>

    <script>
         function updateCartInfo() {
    $.ajax({
        url: '/get-cart-info',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('.itemCount').text(response.itemCount);
            $('.totalPrice').text(response.totalPrice);
        },
        error: function(error) {
            console.error('Error fetching cart information:', error);
        }
    });
}

updateCartInfo();
</script>
    </body>
    
    <!-- Mirrored from wedesignthemes.com/html/redart/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Nov 2023 10:43:54 GMT -->
    </html>
    