@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach($category_name as $key => $cate_pro)
    <h2 class="title text-center">{{$cate_pro -> category_name}}</h2>
    @endforeach
    @foreach($category_by_id as $key => $category_by_id )
    <form action="{{URL::to('/save-cart')}}" method="POST">
        {{ csrf_field() }}
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <a href="{{URL::to('product-details/'.$category_by_id -> product_id)}}">
                        <div class="productinfo text-center">
                            <div class="home-product-item__img"
                                style="background-image: url({{URL::to('public/images/product/'.$category_by_id -> product_image)}});">
                            </div>
                            <input name="qty" type="hidden" value="1" class="qty" />
                            <input name="pro_id" type="hidden" value="{{$category_by_id -> product_id}}" />
                            <h2>{{number_format($category_by_id -> product_price).' '.'vnđ'}}</h2>
                            <p>{{$category_by_id -> product_name}}</p>
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