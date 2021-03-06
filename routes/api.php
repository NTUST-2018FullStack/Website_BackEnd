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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', 'Api\ProductController@index');
Route::get('products/{product}', 'Api\ProductController@show');

Route::get('carts', 'Api\CartController@index');
Route::get('carts/{cart}', 'Api\CartController@show');
Route::get('categories', 'Api\CategoryController@index');

Route::get('types', 'Api\TypeController@index');


Route::post('suggestions/create','Api\SuggestionController@create');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');


Route::get('image/{filename}','PhotoController@image');
Route::get('image','PhotoController@allimage');
Route::post('password/reset','PasswordResetController@create');
Route::get('ads', 'Api\AdController@index');


Route::middleware('auth:api')->group(function () {

    Route::post('sales', 'Api\OrderController@store');
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('me', 'Api\AuthController@me');
//    Route::post('refresh', 'Api\AuthController@refresh');

    Route::post('coupons/check','Api\CouponController@check');
    Route::get('coupons/index','Api\CouponController@index');

    Route::get('sales/index', 'Api\SaleController@index');
    Route::get('sales/{sale}', 'Api\SaleController@salesitems');

    Route::post('carts/delete', 'Api\CartController@delete');
    Route::post('carts/add', 'Api\CartController@add');
    Route::post('carts/sub', 'Api\CartController@sub');
    Route::post('carts/addincart', 'Api\CartController@addincart');
    Route::post('carts/addnumincart', 'Api\CartController@addNumincart');


});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');

    Route::post('reset', 'PasswordResetController@reset')->name('member_reset');
});

