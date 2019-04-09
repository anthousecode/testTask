<?php

use Illuminate\Http\Request;

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



Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {

        return $request->user();
    });

    // public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');

    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
    });

    // Add new product

    Route::post('/addProduct', 'ProductController@addProduct')->middleware('can:add product');

    // Edit Product (Only Admin with access to category with this product)

    Route::post('/editProduct/{product}', 'ProductController@editProduct')->middleware('can:edit product');

    // Show all categories

    Route::get('/showCategory', 'CategoryController@showCategory')->middleware('auth:api');

    // Show only one category with all products

    Route::get('/showCategory/{category}', 'CategoryController@storeCategory')->middleware('auth:api');

    // Show only one product

    Route::get('/product/{product}', 'ProductController@showProduct')->middleware('auth:api');

    // Assign category to admin

    Route::post('/adminCategory', 'CategoryController@adminCategory')->middleware('can:create category');

});
