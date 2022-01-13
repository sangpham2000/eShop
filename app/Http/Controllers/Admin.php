<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
use Log;

session_start();
class Admin extends Controller
{
    //
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->checkLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('tbl_admin')
                ->where(['admin_email' => $admin_email,'admin_password' => $admin_password])
                ->first();
        if ($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');  
        }else{
            Session::put('message', 'Tài khoản hoặc mật khẩu không tồn tại. Vui lòng nhập lại!!!!');
            return Redirect::to('/admin');
        }    
        
    }

    public function logOut(){
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    
    public function manageOrder(){
        $this->checkLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_payment.payment_method', 'tbl_shipping.*')
        ->orderby('tbl_order.order_id', 'desc')->get();
        $manage_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manage_order);
    }

    public function viewOrder($order_id){
        $this->checkLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')->where('tbl_order_details.order_id', $order_id)
        ->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_payment.payment_method', 'tbl_shipping.*', 'tbl_order_details.*')->first();

        $all_product_order = DB::table('tbl_order_details')
        ->join('tbl_order', 'tbl_order_details.order_id', '=', 'tbl_order.order_id' )
        ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')->where('tbl_order_details.order_id', $order_id)
        ->select('tbl_order_details.*', 'tbl_product.product_image')->get();
        $manage_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('all_product_order', $all_product_order);
        return view('admin_layout')->with('admin.view_order', $manage_order_by_id);
    }

    public function deleteOrder($order_id){
        $this->checkLogin();
        DB::table('tbl_order')->where('tbl_order.order_id', $order_id)->delete();
        DB::table('tbl_order_details')->where('tbl_order_details.order_id', $order_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('manage-order');
    }

    public function delete_order_product($product_id){
        $this->checkLogin();
        DB::table('tbl_order_details')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('manage-order');
    }

    public function all_customer(){
        $this->checkLogin();
        $all_customer = DB::table('tbl_customer')->get();
        $manage_customer = view('admin.all_customer')->with('all_customer', $all_customer);

        return view('admin_layout')->with('admin.all_brand', $manage_customer);
    }

    public function delete_customer($customer_id){
        $this->checkLogin();
        DB::table('tbl_customer')->where('tbl_customer.customer_id', $customer_id)->delete();
        return Redirect::to('all-customer');
    }

}
