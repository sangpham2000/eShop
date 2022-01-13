<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
session_start();
class CartController extends Controller
{
    //
    public function save_cart(Request $request){
        $productID = $request->pro_id;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id', $productID)->first(); 
        
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $array['id'] = $product_info->product_id;
        $array['qty'] = $quantity;
        $array['name'] = $product_info->product_name;
        $array['price'] = $product_info->product_price;
        $array['weight'] = '1';
        $array['options']['image'] = $product_info->product_image;
        Cart::add($array);
        // Cart::destroy();
        return Redirect::to('/show-cart');
    }

    public function show_cart(){
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $category_product)->with('brand', $brand_product);
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->quantity_value;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
