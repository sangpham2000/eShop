<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//USER
use App\Http\Controllers\Home;
Route::get('/', [Home::class, 'index']);
Route::get('/trangchu', [Home::class, 'index']);
Route::post('/timkiem', [Home::class, 'search']);


//ADMIN
use App\Http\Controllers\Admin;
Route::get('/admin', [Admin::class, 'index']);
Route::get('/dashboard', [Admin::class, 'show_dashboard']);
Route::get('/logout', [Admin::class, 'logOut']);
Route::get('/all-customer', [Admin::class, 'all_customer']);
Route::get('/manage-order', [Admin::class, 'manageOrder']);
Route::get('/view-order/{order_id}', [Admin::class, 'viewOrder']);
Route::get('/delete-order/{order_id}', [Admin::class, 'deleteOrder']);
Route::get('/delete-order-product/{product_id}', [Admin::class, 'delete_order_product']);
Route::get('/delete-customer/{customer_id}', [Admin::class, 'delete_customer']);
Route::post('/admin-dashboard', [Admin::class, 'dashboard']);

//Category Product
use App\Http\Controllers\CategoryProduct;
Route::get('/danh-muc/{category_id}', [CategoryProduct::class, 'show_category_home']);

Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

//Brand Product
use App\Http\Controllers\BrandProduct;
Route::get('/thuong-hieu/{brand_id}', [BrandProduct::class, 'show_brand_home']);

Route::get('/add-brand', [BrandProduct::class, 'add_brand']);
Route::get('/all-brand', [BrandProduct::class, 'all_brand']);
Route::get('/active-brand/{brand_id}', [BrandProduct::class, 'active_brand']);
Route::get('/unactive-brand/{brand_id}', [BrandProduct::class, 'unactive_brand']);
Route::get('/edit-brand/{brand_id}', [BrandProduct::class, 'edit_brand']);
Route::get('/delete-brand/{brand_id}', [BrandProduct::class, 'delete_brand']);
Route::post('/save-brand', [BrandProduct::class, 'save_brand']);
Route::post('/update-brand/{brand_id}', [BrandProduct::class, 'update_brand']);

//Product
use App\Http\Controllers\Product;
Route::get('/product-details/{product_id}', [Product::class, 'product_details']);

Route::get('/add-product', [Product::class, 'add_product']);
Route::get('/all-product', [Product::class, 'all_product']);
Route::get('/active-product/{product_id}', [Product::class, 'active_product']);
Route::get('/unactive-product/{product_id}', [Product::class, 'unactive_product']);
Route::get('/edit-product/{product_id}', [Product::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [Product::class, 'delete_product']);
Route::post('/save-product', [Product::class, 'save_product']);
Route::post('/update-product/{product_id}', [Product::class, 'update_product']);

// CART
use App\Http\Controllers\CartController;
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);

// CHECKOUT
use App\Http\Controllers\Checkout;
Route::get('/login-checkout', [Checkout::class, 'login_checkout']);
Route::get('/logout-checkout', [Checkout::class, 'logout_checkout']);
Route::get('/checkout', [Checkout::class, 'checkout']);
Route::get('/payment', [Checkout::class, 'payment']);
Route::post('/add-customer', [Checkout::class, 'add_customer']);
Route::post('/save-checkout-customer', [Checkout::class, 'save_checkout_customer']);
Route::post('/login-customer', [Checkout::class, 'login_customer']);
Route::post('/payment', [Checkout::class, 'payment']);