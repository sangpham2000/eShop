<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;

session_start();
class CategoryProduct extends Controller
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

    public function add_category_product(){
        $this->checkLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->checkLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manage_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);

        return view('admin_layout')->with('admin.all_category_product', $manage_category_product);
    }

    public function save_category_product(Request $request){
        $this->checkLogin();
        $array = array();
        $array['category_name'] = $request->category_product_name;
        $array['category_desc'] = $request->category_product_desc;
        $array['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($array);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-category-product');
    }

    public function active_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')
        ->where('category_id', $category_product_id)
        ->update(['category_status' => 0]);
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')
        ->where('category_id', $category_product_id)
        ->update(['category_status' => 1]);
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->checkLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manage_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manage_category_product);
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->checkLogin();
        $array = array();
        $array['category_name'] = $request->category_product_name;
        $array['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($array);
        Session::put('message', 'Cập nhật thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('all-category-product');
    }

    //USER
    public function show_category_home($category_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')->where('tbl_product.category_id', $category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category', $category_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
}
