<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;

session_start();
class Home extends Controller
{
    //
    public function index(){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        $product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id', 'desc')->get();
        return view('pages.home')->with('category', $category_product)->with('brand', $brand_product)->with('product', $product);
    }

    public function search(Request $request){
        $keyword = $request->keyword_input;
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        $search = DB::table('tbl_product')->where('product_name', 'like', '%'.$keyword.'%')->get();
        return view('pages.product.search')->with('category', $category_product)->with('brand', $brand_product)->with('search', $search);
    }
}
