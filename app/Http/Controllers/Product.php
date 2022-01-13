<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;

session_start();
class Product extends Controller
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

    public function add_product(){
        $this->checkLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('category_product', $category_product)->with('brand_product', $brand_product);
    }

    public function all_product(){
        $this->checkLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderby('tbl_product.product_id', 'desc')->get();
        $manage_product = view('admin.all_product')->with('all_product', $all_product);

        return view('admin_layout')->with('admin.all_product', $manage_product);
    }

    public function save_product(Request $request){
        $this->checkLogin();
        $array = array();
        $array['category_id'] = $request->category_id;
        $array['brand_id'] = $request->brand_id;
        $array['product_name'] = $request->product_name;
        $array['product_price'] = $request->product_price;
        $array['product_desc'] = $request->product_desc;
        $array['product_status'] = $request->product_status;
        $array['product_qty'] = $request->product_qty;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/images/product', $new_image);
            $array['product_image'] = $new_image;
            DB::table('tbl_product')->insert($array);
            Session::put('message', 'Thêm thành công');
            return Redirect::to('add-product');
        }
        $array['product_image'] = '';
        DB::table('tbl_product')->insert($array);
        Session::put('message', 'Thêm không thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->update(['product_status' => 0]);
        return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->update(['product_status' => 1]);
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->checkLogin();
        $category_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manage_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('category_product', $category_product)->with('brand_product', $brand_product);

        return view('admin_layout')->with('admin.edit_product', $manage_product);
    }

    public function update_product(Request $request, $product_id){
        $this->checkLogin();
        $array = array();
        $array['category_id'] = $request->category_id;
        $array['brand_id'] = $request->brand_id;
        $array['product_name'] = $request->product_name;
        $array['product_price'] = $request->product_price;
        $array['product_desc'] = $request->product_desc;
        $array['product_status'] = $request->product_status;
        $array['product_qty'] = $request->product_qty;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/images/product', $new_image);
            $array['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($array);
            Session::put('message', 'Cập nhật thành công!');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($array);
        Session::put('message', 'Chưa có thay đổi nào!');
        return Redirect::to('all-product');
    }


    public function delete_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('all-product');
    }

    //USER
    public function product_details($product_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        $product_details = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.product_id', $product_id)->get();
        
        foreach($product_details as $key => $value){
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();
        return view('pages.product.show_product_deatails')
        ->with('category', $category_product)
        ->with('brand', $brand_product)
        ->with('product_details', $product_details)
        ->with('related_product', $related_product);
    }

}
