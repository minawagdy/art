@extends('front.layouts.main')

@section('content')

<div class="breadcrumb">
<div class="container">
<h2>Product <span>Detail</span></h2>
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
<div class="main-title animate" data-animation="pullDown" data-delay="100">
<h3> {{$artist->name}} </h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
</div>
<div class="cart-wrapper">
<div class="dt-sc-three-fifth column first">
<div class="cart-thumb">
<a href="#">
<img style="width: 710px;height:752px;" src="{{asset($maxOrderedProduct->images[0]->image_name)}}"  onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title="Acrylic">
</a>
</div>
<h5>more from this artist</h5>
<ul class="thumblist">
    {{-- @php
   
    $startIndex = 10;
    $counter = $startIndex;
@endphp
@foreach ($artist->products as $key=>$product)
@if ($key != $counter - $startIndex)
@break
@endif

    {{ $counter }}: {{ $product->title }} <br>
    @php
        $counter++;
    @endphp
@endforeach --}}

     @for($i=10;$i<count($artist->products);$i++)
<li>
<a href="#" class="product"><img style="width:100px;height:100px;" src="{{asset(@$artist->products[$i]->images[0]->image_name)}}"  onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title="{{$artist->products[$i]->title}}"></a>
</li>
@endfor

</ul>
<div class="commententries">
<h4> Comments ( {{count($artist->reviews)}} ) </h4>
<h6><a href="#"><i class="fa fa-comments-o"></i>Add Comments</a></h6>
<ul class="commentlist">
<li>
<div class="comment">
<header class="comment-author">
<img title alt="image" src="images/post-img1.jpg">
</header>
<div class="comment-details">
<div class="author-name">
<a href="#">Callahan James</a>
</div>
<div class="commentmetadata"><span>/</span> Acrylic Painting</div>
<div title="Rated 5.00 out of 5" class="star-rating"><span style="width:80%"></span></div>
<div class="comment-body">
<div class="comment-content">
<p>The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
<div class="author-metadata">
<p><span class="fa fa-comments"></span><a href="#"> 19 </a></p>
<p><span class="fa fa-folder-open"> </span><a href="#"> Art</a></p>
<p><span class="fa fa-calendar"></span><a href="#"> 05 Apr 2015 </a></p>
</div>
</div>
</div>
</div>
</div>
<ul class="children">
<li>
<div class="comment">
<header class="comment-author">
<img title alt="image" src="images/post-img2.jpg">
</header>
<div class="comment-details">
<div class="author-name">
<a href="#">Sean Bean</a>
</div>
<div class="commentmetadata"><span>/</span> Sculpture</div>
<div title="Rated 5.00 out of 5" class="star-rating"><span style="width:70%"></span></div>
<div class="comment-body">
<div class="comment-content">
<p>The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>
<div class="author-metadata">
<p><span class="fa fa-comments"></span><a href="#"> 08 </a></p>
<p><span class="fa fa-folder-open"> </span><a href="#"> Creative</a></p>
<p><span class="fa fa-calendar"></span><a href="#"> 26 Aug 2015 </a></p>
</div>
</div>
</div>
</div>
</div>
</li>
</ul>
</li>
</ul>
</div>
</div>
<div class="dt-sc-two-fifth column">

<div class="post-author-details">
<div class="entry-author-image">
<img style="width: 100px;" src="{{$artist->profile_img}}" onerror="this.onerror=null;this.src='{{ asset('user.png') }}';" alt="image" /> </li>

</div>
<div class="author-title">
<h5><a href="#">{{$artist->name}}</a></h5>
<span>{{@$artist->zoneObj->name}} , {{@$artist->govObj->title}} - {{@$artist->countryObj->name}}</span>
<div class="woocommerce-product-rating">
<div title="Rated {{$artist->AvgRate}} out of 5" class="star-rating"><span style="width:{{$artist->AvgRate * 100}}%"></span></div>
<a href="#">( {{$artist->reviews->count('rate')}} customer reviews )</a>
</div>
</div>
<div class="author-desc">
<p>{{$artist->description}}</p>
</div>
</div>

<ul class="cart-thumb-categories">
    <ul style="height: 565px;" class="cart-thumb-categories">
        @php $counter = 1; @endphp
        @foreach ($artist->products as $product)
        @if($maxOrderedProduct->id != $product->id)
        <li @if($counter % 3 == 0) class="last" @endif>
            <a href="#" class="product"><img style="width: 100px;height:100px;" src="{{$product->MainImage}}"  onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title></a>     
               <div class="category-details">
        <h6 style="width: 150px;text-align:left;"><a href="#">  {{$product->title}}  </a> </h6>
        <span> {{$product->MinPrice}} </span>
        </div>
        </li>
        @php $counter++; @endphp
        @if ($counter == 10)
        @break
        @endif
        @endif
        @endforeach
        </ul>
        <div class="project-details">
        <ul class="client-details">
        <li>
        <p><span>Title :</span>{{$maxOrderedProduct->title}}</p>
        </li>
        <li>
        <p><span>Artist :</span>{{$maxOrderedProduct->provider->name}}</p>
        </li>
        <li>
        <p><span>Category :</span>{{$maxOrderedProduct->category->title_en}}</p>
        </li>
        <li>
        <p><span>Description :</span>{{$maxOrderedProduct->description}}</p>
        </li>
        <li>
            @php
                $dateStringWithoutAtSymbol = str_replace('@', '', $maxOrderedProduct->created_at);
                $formattedDate = \Carbon\Carbon::parse($dateStringWithoutAtSymbol)->isoFormat('MMM Do, YYYY');

            @endphp
        <p><span>Uploaded :</span>{{$formattedDate}}</p>
        </li>
        <li>
        <p><span>Statistics :</span><i class="fa fa-eye"></i>2,318</p>
        </li>
        <li>
        <p><span>Colors :</span><a href="#" class="yellow"></a><a href="#" class="green"></a><a href="#" class="orange"></a><a href="#" class="red"></a></p>
        </li>
        <li>
        <p><span>Sales Sheet :</span>PDF</p>
        </li>
        <li>
        <p>
        <span>Tags :</span>
        <div class="tagcloud type3">
        <a href="#">Sketches</a>
        <a href="#">Fashion</a>
        <a href="#">Art</a>
        <a href="#">Rain</a>
        <a href="#">Scupture</a>
        <a href="#">Lonely</a>
        <a href="#">Oil color</a>
        <a href="#">Gallery</a>
        <a href="#">Mordern Art</a>
        </div>
        </p>
        </li>
        </ul>
        </div>
        </div>
        </div>
        <span class="star-rating1 star-5">
            <input class="m1" type="radio" name="rating" value="1"><i></i>
            <input class="m1" type="radio" name="rating" value="2"><i></i>
            <input class="m1" type="radio" name="rating" value="3"><i></i>
            <input class="m1" type="radio" name="rating" value="4"><i></i>
            <input class="m1" type="radio" name="rating" value="5"><i></i>
          </span>
  {{-- Post Comments --}}
  <div class="card mt-4">
    <h5 class="card-header">Comments <span class="comment-count float-right badge badge-info">{{ count($artist->reviews) }}</span></h5>
    <div class="card-body">
        {{-- Add Comment --}}
        <div class="add-comment mb-3">
            @csrf
            <textarea class="form-control commentt" placeholder="Enter Comment"></textarea>
            
            <button type="submit"  class="btn btn-dark btn-sm mt-2 save-comment">Post</button>
        </div>
        <hr/>
        {{-- List Start --}}
        <div class="comments"> 
            @if(count($artist->reviews)>0)
                @foreach($artist->reviews as $comment)
                    <blockquote class="blockquote">
                      <small class="mb-0">{{ $comment->notes }}</small>
                    </blockquote>
                    <hr/>
                @endforeach
            @else
            <p class="no-comments">No Comments Yet</p>
            @endif
        </div>
    </div>
</div>
{{-- ## End Post Comments --}}
{{-- @endsection --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // This WILL work because we are listening on the 'document', 
    // for a click on an element with an ID of #test-element
    $(".save-comment").on('click',function(){
        var _comment=$(".commentt").val();
        var _post={{$artist->id}};
        var _rate = $(".m1:checked").val();
        var _user_id = 1;
    var vm=$(this);
    if (!_rate) {
            alert('Please rate the item.');
            return;
        }
    // Run Ajax
    $.ajax({
        url:"{{ url('save-comment') }}",
        type:"post",
        dataType:'json',
        data:{
            comment:_comment,
            post:_post,
            rate:_rate,
            user_id:_user_id,
            _token:"{{ csrf_token() }}"
        },
        beforeSend:function(){
          
            vm.text('Saving...').addClass('disabled');
        },
        success:function(res){
            var _html='<blockquote class="blockquote animate__animated animate__bounce">\
            <small class="mb-0">'+_comment+'</small>\
            </blockquote><hr/>';
            if(res.bool==true){
                $(".comments").prepend(_html);
                $(".commentt").val('');
                $(".comment-count").text($('blockquote').length);
                $(".no-comments").hide();
            }
            vm.text('Save').removeClass('disabled');
        }   
    });
});



    </script>

@endsection



  <style>
    .star-rating1 {
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  /* width: 250px; remove this */
  height: 50px;
  overflow: hidden;
  position: relative;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating1 i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  /* width: 20%; remove this */
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating1 input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  /* width: 20%; remove this */
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
}
.star-rating1 input:hover + i,
.star-rating1 input:checked + i {
  opacity: 1;
}
.star-rating1 i ~ i {
  width: 40%;
}
.star-rating1 i ~ i ~ i {
  width: 60%;
}
.star-rating1 i ~ i ~ i ~ i {
  width: 80%;
}
.star-rating1 i ~ i ~ i ~ i ~ i {
  width: 100%;
}
/* ::after,
::before {
  height: 100%;
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  text-align: center;
  vertical-align: middle;
} */

.star-rating1.star-5 {width: 250px;}
.star-rating1.star-5 input,
.star-rating1.star-5 i {width: 20%;}
.star-rating1.star-5 i ~ i {width: 40%;}
.star-rating1.star-5 i ~ i ~ i {width: 60%;}
.star-rating1.star-5 i ~ i ~ i ~ i {width: 80%;}
.star-rating1.star-5 i ~ i ~ i ~ i ~i {width: 100%;}

</style>