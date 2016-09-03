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
    return view('login');
});




Route::get('/auth/oauth', 'Auth\AuthController@oauth');
# 微信接口回调地址
Route::get('/auth/callback', 'Auth\AuthController@callback');
