<?php

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
Route::resource('shops','ShopController');
Route::post('upload','ShopController@upload')->name('upload');



Route::get('login','SessionController@login')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::get('logout','SessionController@logout')->name('logout');
Route::get('shop/pwd','ShopController@pwd')->name('shop.pwd');
Route::post('shop/save','ShopController@save')->name('shop.save');

Route::get('menucategory/list','MenuCategoryController@list')->name('menucategory.list');
Route::get('menucategory/search','MenuCategoryController@search')->name('menucategory.search');
Route::resource('menucategorys','MenuCategoryController');


//Route::get('menu/list','MenuController@list')->name('menu.list');
Route::resource('menus','MenuController');

Route::post('upload','MenuController@upload')->name('upload');

Route::resource('activitys','ActivityController');

//订单
Route::post('order/save/{order}','OrderController@save')->name('order.save');
Route::post('order/del/{order}','OrderController@del')->name('order.del');
Route::resource('orders','OrderController');

//统计
//商户端
//商户端最近一周订单销量统计
Route::get('tong/week','TongJiController@week')->name('tong.week');
//商户端最近三个月的订单统计
Route::get('tong/month','TongJiController@month')->name('tong.month');
//商户端最近一周菜品销量统计
Route::get('tong/look','TongJiController@look')->name('tong.look');
//商户端最近三月菜品销量统计
Route::get('tong/monthes','TongJiController@monthes')->name('tong.monthes');
