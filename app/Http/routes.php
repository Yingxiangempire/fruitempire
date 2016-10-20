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


Route::get('/', function () {
    View::addExtension('html','blade');
    return view('index');
});
//Route::get('/admin', 'Admin\IndexController@getIndex');
Route::get('/admin', function () {
    \Config::set('wechat.oauth.callback','/auth/callback2?second=add');
    $wechat = app('wechat');
    $response = $wechat->oauth->scopes(['snsapi_userinfo'])->redirect();
    $response->send();
});


Route::controller('/test', 'TestController');
Route::get('/auth/oauth', 'Auth\AuthController@oauth');
# 微信接口回调地址
Route::get('/auth/callback', 'Auth\AuthController@callback');
Route::get('/auth/callback2', 'Auth\AuthController@callback2');
Route::controller('/auth', 'AuthController');
#微信调用接口默认不能随意修改
Route::any('/wechat', 'WechatController@serve');





/*************************管理后台路由***********************/
Route::controller('/admin_auth', 'Admin\AuthController');
Route::controller('/admin_base', 'Admin\BaseController');
Route::controller('/aaccount', 'Admin\AccountController');
Route::controller('/abaseinfo', 'Admin\BaseInfoController');
/*************************管理后台路由***********************/