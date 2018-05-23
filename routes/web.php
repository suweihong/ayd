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


Route::get('/aa',function(){
	dump(333);
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//核心系统登录
Route::any('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout');


Route::get('/','LoginController@index');//首页
Route::resource('advertisements','AdvertisementController'); //广告
Route::resource('bills','BillController');//账单
Route::resource('types/{types}/complaints','ComplaintController');//反馈
Route::resource('messages','MessageController');//私信
Route::resource('notices','NoticeController');//公告
Route::resource('orders','OrderController');//订单
Route::resource('stores','StoreController');//店铺
Route::resource('mpusers','MpuserController');//店主
Route::resource('staffs','StaffController');//店铺员工
Route::resource('types','TypeController');//体育品类
