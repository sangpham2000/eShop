@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Khách hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Hình thức vận chuyển</th>
            <!-- <th style="width:190px;"></th> -->
          </tr>
        </thead>
        <tbody>

          <tr>
            <td><span class="text-ellipsis">{{$order_by_id -> customer_name}}</span></td>
            <td><span class="text-ellipsis">{{$order_by_id -> shipping_address}}</span></td>
            <td><span class="text-ellipsis">{{$order_by_id -> shipping_phone}}</span></td>
            <td><span class="text-ellipsis">{{$order_by_id -> payment_method}}</span></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
        </select>
        <button class="btn btn-sm btn-default">Áp dụng</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
        
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
            <th>Sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th style="width:190px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product_order as $key => $all)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td><span class="text-ellipsis">{{$all -> product_name}}</span></td>
            <td><img  src="{{asset('public/images/product/'.$all -> product_image)}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">{{$all -> product_sales_quantity}}</span></td>
            <td><span class="text-ellipsis">{{number_format($all -> product_price).' '.'vnđ'}}</span></td>
            <td>
              <a href="" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active">Chỉnh sửa</i>
              </a> 
              <a onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')" href="{{URL::to('/delete-order-product/'.$all->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text">Xoá</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection()