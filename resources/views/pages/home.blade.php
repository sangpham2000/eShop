@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">TẤT CẢ SẢN PHẨM</h2>
    @foreach($product as $key => $product )
    <form action="{{URL::to('/save-cart')}}" method="POST">
        {{ csrf_field() }}
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <a href="{{URL::to('product-details/'.$product -> product_id)}}">
                        <div class="productinfo text-center">
                            <div class="home-product-item__img"
                                style="background-image: url({{URL::to('public/images/product/'.$product -> product_image)}});">
                            </div>
                            <input name="qty" type="hidden" value="1" class="qty" />
                            <input name="pro_id" type="hidden" value="{{$product -> product_id}}" />
                            <h2>{{number_format($product -> product_price).' '.'vnđ'}}</h2>
                            <p>{{$product -> product_name}}</p>
                            <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </form>
    @endforeach
    
</div><!--features_items-->
@endsection