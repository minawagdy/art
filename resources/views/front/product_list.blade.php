@foreach($products as $product)
<div class="portfolio {{$product->category_id}} dt-sc-one-fourth">
<figure>
<img src="{{asset(@$product->images[0]->image_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';" alt title>
<figcaption>
<div class="portfolio-detail">
<div class="views">
<a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="{{asset(@$product->images[0]->image_name)}}" onerror="this.onerror=null;this.src='{{ asset('product_sample_icon_picture.png') }}';"></a><span>3</span>
</div>
<div class="portfolio-title">
<h5><a href="{{url('item/'.$product->id)}}">{{$product->title}}</a></h5>
<p><a style="color: white;"  href="{{url('artist/'.$product->provider->id)}}">{{@$product->provider->name}}</a></p>
    <br>
    <p><a style="color: white;"  href="{{url('category/'.@$product->category->id)}}">{{@$product->category->title_en}}</a></p>
</div>
</div>
</figcaption>
</figure>
</div>
@endforeach