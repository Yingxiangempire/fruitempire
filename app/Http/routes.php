<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/index', function () {
    View::addExtension('html','blade');
    return view('index');
});
Route::get('/admin', function () {
    View::addExtension('html','blade');
    return view('login');
});


Route::controller('/test', 'TestController');
Route::get('/auth/oauth', 'Auth\AuthController@oauth');
# 微信接口回调地址
Route::get('/auth/callback', 'Auth\AuthController@callback');
Route::controller('/auth', 'AuthController');
#微信调用接口默认不能随意修改
Route::any('/wechat', 'WechatController@serve');





/*************************管理后台路由***********************/
Route::controller('/admin_auth', 'Admin\AuthController');
/*************************管理后台路由***********************/