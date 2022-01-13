@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    @foreach($edit_product as $key => $product)
                        <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                        {{method_field('post')}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại hàng</label>
                                <select name="category_id" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key => $category)
                                    @if($category->category_id == $product->category_id)
                                    <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @else
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                                <select name="brand_id" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                    @if($brand->brand_id == $product->brand_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="text" class="form-control" name="product_price" value="{{$product->product_price}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control" name="product_image">
                            <label for="exampleInputEmail1">Hình ảnh hiện tại</label>
                            <img  src="{{URL::to('public/images/product/'.$product->product_image)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="10" class="form-control" name="product_desc">{{$product->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" class="form-control" name="product_qty" value="{{$product->product_qty}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach 
                    </div>

                </div>
            </section>
    </div>
</div>
@endsection()