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

Route::get('/', function () {
    return view('layouts/master');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Contracts\Session\Session;

Route::get('/test', function () {
    // return phone::find(1)->typephone->name;

    // $order = Order::find(1);
    // $order_data = array(
    //     'data' => $order,
    //     'user' => $order->user,
    //     'detail' => $order->detail
    // );


    // $detail = Order_detail::where('order_id', 'like', '%' . $order->id . '%')->get();
    // $product_detail = $detail[0]->product;
    // $detail = Order_detail::where('order_id', 'like' , '%'.$order->id.'%')->get();
    // $product_detail = $detail[0]->product;
    // $username = $order->user->name;
    // $order = Auth::user()->id;

    // $order = Order::where('ref_id', 'like' ,'PO202310141')->get();
    // $order_id = $order[0]->id;

    $po_no = 'PO'.date("Ymd");
    $order = Order::where('ref_id', 'like' , '%'.$po_no.'%')->get();
    $order_count = $order->count();
    $new_ref_id = $po_no.($order_count+1);

    return compact('new_ref_id');

    // return Order_detail::find(1)->order->status;
    // return User::find(1)->name;
    // return Order::with(['name'])->where('user_id', '1');
});

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/product/edit/{id?}', [App\Http\Controllers\ProductController::class, 'edit']);
Route::get('/product/remove/{id?}', [App\Http\Controllers\ProductController::class, 'remove']);
Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::post('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update']);
Route::post('/product/insert', [App\Http\Controllers\ProductController::class, 'insert']);

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/category/edit/{id?}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::get('/category/remove/{id?}', [App\Http\Controllers\CategoryController::class, 'remove']);
Route::get('/category/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::post('/category/search', [App\Http\Controllers\CategoryController::class, 'search']);
Route::post('/category/update', [App\Http\Controllers\CategoryController::class, 'update']);
Route::post('/category/insert', [App\Http\Controllers\CategoryController::class, 'insert']);

Route::get('/cart/view', [App\Http\Controllers\CartController::class, 'viewCart']);
Route::get('/cart/add/{id?}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('/cart/delete/{id?}', [App\Http\Controllers\CartController::class, 'deleteCart']);
Route::get('/cart/update/{id}/{qty}', [App\Http\Controllers\CartController::class, 'updateCart']);
Route::get('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout']);
Route::get('/cart/complete', [App\Http\Controllers\CartController::class, 'complete']);
Route::get('/cart/finish', [App\Http\Controllers\CartController::class, 'finish_order']);

Route::get('/order', [App\Http\Controllers\OrderController::class, 'index']);
Route::get('/order/insertOrder', [App\Http\Controllers\OrderController::class, 'insertOrder']);
Route::get('/order/insertDetail', [App\Http\Controllers\OrderController::class, 'insertDetail']);
Route::get('/order/report/{ref_id}', [App\Http\Controllers\OrderController::class, 'reportOrder']);

Route::get('/order/detail/{id?}', [App\Http\Controllers\OrderdetailController::class, 'viewDetail']);
Route::get('/order/detail/update/{id?}/{status?}', [App\Http\Controllers\OrderdetailController::class, 'update']);

Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/edit/{id?}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/user/remove/{id?}', [App\Http\Controllers\UserController::class, 'remove']);
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::post('/user/insert', [App\Http\Controllers\UserController::class, 'insert']);

