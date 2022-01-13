<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;

session_start();

class BrandProduct extends Controller
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

    public function add_brand(){
        $this->checkLogin();
        return view('admin.add_brand');
    }

    public function all_brand(){
        $this->checkLogin();
        $all_brand = DB::table('tbl_brand')->get();
        $manage_brand = view('admin.all_brand')->with('all_brand', $all_brand);

        return view('admin_layout')->with('admin.all_brand', $manage_brand);
    }

    public function save_brand(Request $request){
        $this->checkLogin();
        $array = array();
        $array['brand_name'] = $request->brand_name;
        $array['brand_desc'] = $request->brand_desc;
        $array['brand_status'] = $request->brand_status;
        
        DB::table('tbl_brand')->insert($array);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-brand');
    }

    public function active_brand($brand_id){
        $this->checkLogin();
        DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->update(['brand_status' => 0]);
        return Redirect::to('all-brand');
    }

    public function unactive_brand($brand_id){
        $this->checkLogin();
        DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->update(['brand_status' => 1]);
        return Redirect::to('all-brand');
    }

    public function edit_brand($brand_id){
        $this->checkLogin();
        $edit_brand = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();
        $manage_brand = view('admin.edit_brand')->with('edit_brand', $edit_brand);

        return view('admin_layout')->with('admin.edit_brand', $manage_brand);
    }

    public function update_brand(Request $request, $brand_id){
        $this->checkLogin();
        $array = array();
        $array['brand_name'] = $request->brand_name;
        $array['brand_desc'] = $request->brand_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_id)->update($array);
        Session::put('message', 'Cập nhật thành công');
        return Redirect::to('all-brand');
    }

    public function delete_brand($brand_id){
        $this->checkLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('all-brand');
    }

    // USER
    public function show_brand_home($brand_id){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $category_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
