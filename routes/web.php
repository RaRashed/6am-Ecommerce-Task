<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin',  'middleware' => 'role'], function()
{
    Route::get('/', 'HomeController@adminHome')->name('admin.home');
    Route::resource('category', 'CategoryController');
    Route::resource('brand','BrandController');
Route::resource('product','ProductController');
Route::resource('coupon','CouponContoller');
Route::delete('image/{img_id}/delete','ImageController@Imagedestroy')->name('destroyimage');
});


Route::group(['prefix' => 'frontend',  'middleware' => 'role'], function()
{
    route::get('/','FrontendController@index')->name('frontend');
route::get('cart','FrontendController@cart')->name('cart');

Route::get('add-to-cart/{id}', 'FrontendController@addToCart');

Route::post('addcoupon', 'FrontendController@applyCoupon')->name('addcoupon');
Route::get('checkout', 'FrontendController@checkout')->name('checkout');

Route::post('update-cart', 'FrontendController@update');
Route::post('remove-from-cart', 'FrontendController@remove');

});













