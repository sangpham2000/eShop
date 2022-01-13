<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
session_start();

class Checkout extends Controller
{
    //
    public function login_checkout(){
        return view('pages.checkout.login_checkout');
    }

    public function add_customer(Request $request){
        $array = array();
        $array['customer_name'] = $request->name_register;
        $array['customer_email'] = $request->email_register;
        $array['customer_phone'] = $request->phone_number;
        $array['customer_password'] = md5($request->password_register);

        $customer_id = DB::table('tbl_customer')->insertGetId($array);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->name_register);

        return Redirect::to('/login-checkout');
    }

    public function checkout(){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.checkout')->with('category', $category_product)->with('brand', $brand_product);
    }

    public function save_checkout_customer(Request $request){
        // Thông tin khách hàng
        $array = array();
        $array['shipping_name'] = $request->shipping_name;
        $array['shipping_email'] = $request->shipping_email;
        $array['shipping_phone'] = $request->shipping_phone;
        $array['shipping_address'] = $request->shipping_address;
        $array['shipping_note'] = $request->shipping_note;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($array);

        Session::put('shipping_id', $shipping_id);
        // Hình thức thanh toán 
        $array2 = array();
        $array2['payment_method'] = $request->payment_option;
        $array2['payment_status'] = "Đang xử lý";
        $payment_id = DB::table('tbl_payment')->insertGetId($array2);

        // Thông tin order
        $array3 = array();
        $array3['customer_id'] = Session::get('customer_id');
        $array3['shipping_id'] = $shipping_id;
        $array3['payment_id'] = $payment_id;
        $array3['order_total'] = Cart::subtotal(0);
        $array3['order_status'] = "Đang xử lý";
        $order_id = DB::table('tbl_order')->insertGetId($array3);
        
        // Thông tin sản phẩm mua
        $content = Cart::content();
        foreach($content as $v_content){
            $array4 = array();
            $array4['order_id'] = $order_id;
            $array4['product_id'] = $v_content->id;
            $array4['product_name'] = $v_content->name;
            $array4['product_price'] = $v_content->price;
            $array4['product_sales_quantity'] = $v_content->qty; 
            DB::table('tbl_order_details')->insertGetId($array4);
        }
        Cart::destroy();
        return Redirect::to('/payment');
    }

    public function payment(){
        return view('pages.checkout.payment');
    }

    public function login_customer(Request $request){
        $email = $request->email_login;
        $password = md5($request->password_login);
        $result = DB::table('tbl_customer')
                    ->where(['customer_email' => $email,'customer_password' => $password])
                    ->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/trangchu');
        }else{
            return Redirect::to('/login-checkout');
        }

    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

}
