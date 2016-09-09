<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;


class AuthController extends Controller
{
    public function getToken()
    {
        return \Request::input("echostr");
    }



}