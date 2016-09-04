<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function getPhp()
    {
        echo phpinfo();
    }
}