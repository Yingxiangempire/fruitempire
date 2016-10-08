<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/8/15
 * Time: 下午4:34
 */

namespace App\Http\Controllers\Admin;


use App\Models\Admin;
use Session;
use View;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{

    public function postLogin()
    {
        $name = inputGetOrFail("name");
        $password = inputGetOrFail('password');
        $password = getPassword($password);
        $admin = Admin::getNamePassword($name, $password)->toArray();
        if ($admin && $admin['state']) {
            setcookie('admin',json_encode($admin),time()+60*360,'/');
        } elseif ($admin && !$admin['state']) {
            throw new \Exception('账号被禁用,请联系管理员');
        } else {
            throw new \Exception("账号或密码错误");
        }
    }

    public function getLogout()
    {
        Session::flush();
        View::addExtension('html','blade');
        return  view('index');
    }


    public static function login($user)
    {
        return $user;
    }
}