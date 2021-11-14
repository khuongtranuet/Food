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
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('layouts/be_master_view');
    });

    Route::prefix('home')->group(function () {
        Route::post('/ajax_district', [
            'as' => 'admin.home.ajax_district',
            'uses' => 'Admin\HomeController@ajax_district',
        ]);
        Route::post('/ajax_ward', [
            'as' => 'admin.home.ajax_ward',
            'uses' => 'Admin\HomeController@ajax_ward',
        ]);
    });

    Route::prefix('category')->group(function () {
        Route::get('/index', [
            'as' => 'admin.category.index',
            'uses' => 'Admin\CategoryController@index',
        ]);
        Route::post('/ajax_list', [
            'as' => 'admin.category.ajax_list',
            'uses' => 'Admin\CategoryController@ajax_list',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'admin.category.detail',
            'uses' => 'Admin\CategoryController@detail',
        ]);
        Route::get('/add', [
            'as' => 'admin.category.add',
            'uses' => 'Admin\CategoryController@add',
        ]);
        Route::post('/store', [
            'as' => 'admin.category.store',
            'uses' => 'Admin\CategoryController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'admin.category.edit',
            'uses' => 'Admin\CategoryController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.category.update',
            'uses' => 'Admin\CategoryController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'admin.category.delete',
            'uses' => 'Admin\CategoryController@delete',
        ]);
    });

    Route::prefix('product')->group(function () {
        Route::get('/index', [
            'as' => 'admin.product.index',
            'uses' => 'Admin\ProductController@index',
        ]);
        Route::post('/ajax_list', [
            'as' => 'admin.product.ajax_list',
            'uses' => 'Admin\ProductController@ajax_list',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'admin.product.detail',
            'uses' => 'Admin\ProductController@detail',
        ]);
        Route::get('/add', [
            'as' => 'admin.product.add',
            'uses' => 'Admin\ProductController@add',
        ]);
        Route::post('/store', [
            'as' => 'admin.product.store',
            'uses' => 'Admin\ProductController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'admin.product.edit',
            'uses' => 'Admin\ProductController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.product.update',
            'uses' => 'Admin\ProductController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'admin.product.delete',
            'uses' => 'Admin\ProductController@delete',
        ]);
    });

    Route::prefix('customer')->group(function () {
        Route::get('/index', [
            'as' => 'admin.customer.index',
            'uses' => 'Admin\CustomerController@index',
        ]);
        Route::post('/ajax_list', [
            'as' => 'admin.customer.ajax_list',
            'uses' => 'Admin\CustomerController@ajax_list',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'admin.customer.detail',
            'uses' => 'Admin\CustomerController@detail',
        ]);
        Route::get('/add', [
            'as' => 'admin.customer.add',
            'uses' => 'Admin\CustomerController@add',
        ]);
        Route::post('/store', [
            'as' => 'admin.customer.store',
            'uses' => 'Admin\CustomerController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'admin.customer.edit',
            'uses' => 'Admin\CustomerController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.customer.update',
            'uses' => 'Admin\CustomerController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'admin.customer.delete',
            'uses' => 'Admin\CustomerController@delete',
        ]);
    });

    Route::prefix('order')->group(function () {
        Route::get('/index', [
            'as' => 'admin.order.index',
            'uses' => 'Admin\OrderController@index',
        ]);
        Route::post('/ajax_list', [
            'as' => 'admin.order.ajax_list',
            'uses' => 'Admin\OrderController@ajax_list',
        ]);
        Route::post('/get_address', [
            'as' => 'admin.order.get_address',
            'uses' => 'Admin\OrderController@get_address',
        ]);
        Route::post('/get_voucher', [
            'as' => 'admin.order.get_voucher',
            'uses' => 'Admin\OrderController@get_voucher',
        ]);
        Route::post('/get_price', [
            'as' => 'admin.order.get_price',
            'uses' => 'Admin\OrderController@get_price',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'admin.order.detail',
            'uses' => 'Admin\OrderController@detail',
        ]);
        Route::get('/add', [
            'as' => 'admin.order.add',
            'uses' => 'Admin\OrderController@add',
        ]);
        Route::post('/store', [
            'as' => 'admin.order.store',
            'uses' => 'Admin\OrderController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'admin.order.edit',
            'uses' => 'Admin\OrderController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.order.update',
            'uses' => 'Admin\OrderController@update',
        ]);
//        Route::get('/delete/{id}', [
//            'as' => 'admin.order.delete',
//            'uses' => 'Admin\OrderController@delete',
//        ]);
    });

    Route::prefix('shipment')->group(function () {
        Route::get('/index', [
            'as' => 'admin.shipment.index',
            'uses' => 'Admin\ShipmentController@index',
        ]);
        Route::post('/ajax_list', [
            'as' => 'admin.shipment.ajax_list',
            'uses' => 'Admin\ShipmentController@ajax_list',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'admin.shipment.detail',
            'uses' => 'Admin\ShipmentController@detail',
        ]);
        Route::get('/cancel/{id}', [
            'as' => 'admin.shipment.cancel',
            'uses' => 'Admin\ShipmentController@cancel',
        ]);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
