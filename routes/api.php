<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['namespace' => 'Api'], function () {
    Route::prefix('v1')->group(function () {
        /**
         * http://localhost:8000/api/v1/register
         */
        Route::post('register', 'RegisterController@register');

        /**
         * http://localhost:8000/api/v1/login
         */
        Route::post('login', 'LoginController@login');

        /**
         * http://localhost:8000/api/v1/refresh_token
         */
        Route::post('refresh_token', 'LoginController@refresh_token')->middleware('checkToken');

        /**
         * http://localhost:8000/api/v1/delete_token
         */
        Route::post('delete_token', 'LoginController@delete_token')->middleware('checkToken');

        /**
         * http://localhost:8000/api/v1/provinces
         * http://localhost:8000/api/v1/districts?province_id=
         * http://localhost:8000/api/v1/wards?district_id=
         */
        Route::get('provinces', 'CustomerController@provinces');
        Route::get('districts', 'CustomerController@districts');
        Route::get('wards', 'CustomerController@wards');

        /**
         * http://localhost:8000/api/v1/categories
         * http://localhost:8000/api/v1/categories?id=&keyword=&selection=
         */
        Route::prefix('categories')->group(function (){
            Route::get('/', 'CategoryController@listing');
        });

        /**
         * http://localhost:8000/api/v1/foods
         * http://localhost:8000/api/v1/foods?id=&category=&keyword=&selection=
         */
        Route::prefix('foods')->group(function (){
            Route::get('/', 'FoodController@listing');
        });

        /**
         * http://localhost:8000/api/v1/customers
         */
        Route::prefix('customers')->middleware('checkToken')->group(function (){
            Route::get('/', 'CustomerController@detail');
        });

        /**
         * http://localhost:8000/api/v1/addresses
         */
        Route::prefix('addresses')->middleware('checkToken')->group(function (){
            Route::get('/', 'CustomerController@address');
        });

        /**
         * http://localhost:8000/api/v1/carts
         */
        Route::prefix('carts')->middleware('checkToken')->group(function (){
            Route::get('/', 'CartController@detail');
            Route::post('/update', 'CartController@update');
        });
    });
});
