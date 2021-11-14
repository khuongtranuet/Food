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
    });
});
