@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục sản phẩm
    </div>
      <?php
        $message = Session::get('message');
        if($message){
            echo $message;
            Session::put('message', null);
        }
      ?>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Tình trạng hiển thị</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Giá</th>
            <th>Chi tiết</th> 
            <th>Số lượng</th>
            <th style="width:190px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $product)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$product -> product_name}}</td>
            <td><span class="text-ellipsis">
            <?php
              if($product->product_status == 0){
            ?>
              <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-times"></span></a>
            <?php 
              }else{
            ?>  
              <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-check"></span></a>
            <?php  
            }                        
            ?>
            </span></td>
            <td><img  src="public/images/product/{{$product->product_image}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">{{$product->category_name}}</span></td>
            <td><span class="text-ellipsis">{{$product->brand_name}}</span></td>
            <td><span class="text-ellipsis">{{$product->product_price}}đ</span></td>
            <td><span class="text-ellipsis">{{$product->product_desc}}</span></td>
            <td><span class="text-ellipsis">{{$product->product_qty}}</span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active">Chỉnh sửa</i>
              </a> 
              <a onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text">Xoá</i>
              </a>
            </td>
          </tr>
          @endforeach()
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">.</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection()