<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/15
 * Time: 下午2:17
 */

namespace App\Http\Controllers\Admin;


use App\Logic\Home\LUser;
use App\Models\FtUser;

class AccountController extends BaseController
{

    public function getUsers()
    {
        $type=inputGet('type','');
        return FtUser::getUser($type);
    }
    
    public function postUpdate()
    {
        if(inputGet('password')){
            $password=getPassword(inputGet('password'));
        }else{
            $password='';
        }
      return  LUser::updateUser(inputGetOrFail('id'),inputGet('nick_name','') , '', '', 0, $password, inputGet('mobile',''),inputGet('state',''));
    }

}