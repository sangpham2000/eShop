@extends('welcome')
@section('content')

@foreach($product_details as $key => $value_details)
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <div class="home-product-item__img"
                style="background-image: url({{URL::to('/public/images/product/'.$value_details -> product_image)}});">
            </div>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{asset('public/frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$value_details -> product_name}}</h2>
            <p>ID: {{$value_details -> product_id}}</p>
            <div class="product-item__rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <form action="{{URL::to('/save-cart')}}" method="POST">
            {{ csrf_field() }}
                <span>
                    <span>{{number_format($value_details -> product_price).' '.'vnđ'}}</span>
                    <label>Số lượng:</label>
                    <input name="qty" type="number" value="1" min="1" class="qty" />
                    <input name="pro_id" type="hidden" value="{{$value_details -> product_id}}" />
                </span>
                <p><b>Tình trạng:</b> Còn hàng</p>
                <p><b>Loại hàng:</b> Mới</p>
                <p><b>Thương hiệu:</b> {{$value_details -> brand_name}}</p>
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm hàng vào giỏ
                </button>
            </form>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
@endforeach
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Sản phẩm liên quan</a></li>
            <li><a href="#reviews" data-toggle="tab">Nhận xét</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            @foreach($related_product as $key => $rel_pro)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <a href="{{URL::to('product-details/'.$rel_pro -> product_id)}}">
                            <div class="productinfo text-center">
                                <div class="home-product-item__img"
                                    style="background-image: url({{URL::to('/public/images/product/'.$rel_pro -> product_image)}});">
                                </div>
                                <h2>{{number_format($rel_pro -> product_price).' '.'vnđ'}}</h2>
                                <p>{{$rel_pro -> product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm hàn vào giở</button>
                            </div>
                        <a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                <?php
                    $customer_name = Session::get('customer_name');

                ?>
                    <li><a href=""><i class="fa fa-user"></i>{{$customer_name}}</a></li>
                </ul>
                <p><b>Viết nhận xét của bạn</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <button type="button" class="btn btn-default pull-right">
                        Gửi
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endsection