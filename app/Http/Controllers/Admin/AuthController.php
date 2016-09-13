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

    public function getLogin($oauthUser='')
    {
        $name=inputGetOrFail('name');
        $password=getPassword(inputGetOrFail('password'));
        $administer=Admin::getNamePassword($name,$password)->toArray();
        $his_administer = Session::get('administer');
        if (!$his_administer ||$his_administer['id'] !=$administer['id'] ) {
            Session::flush();
            Session::put('administer', $administer);
            Session::regenerate();
        }
        return $administer;
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