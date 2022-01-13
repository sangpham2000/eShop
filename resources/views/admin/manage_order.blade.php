@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Áp dụng</button>                
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
            <th>Mã đơn hàng</th>
            <th>Người đặt</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tổng đơn</th>
            <th>Hình thức vận chuyển</th>
            <th>Tình trạng đơn hàng</th>
            <th style="width:190px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key => $order)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td><span class="text-ellipsis">{{$order -> order_id}}</span></td>
            <td><span class="text-ellipsis">{{$order -> customer_name}}</span></td>
            <td><span class="text-ellipsis">{{$order -> shipping_phone}}</span></td>
            <td><span class="text-ellipsis">{{$order -> shipping_address}}</span></td>
            <td><span class="text-ellipsis">{{$order -> order_total}} vnđ</span></td>
            <td><span class="text-ellipsis">{{$order -> payment_method}}</span></td>
            <td><span class="text-ellipsis">{{$order -> order_status}}</span></td>
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active">Chi tiết đơn hàng</i>
              </a> 
              <a onclick="return confirm('Bạn có chắc muốn xoá đơn hàng này không?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
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