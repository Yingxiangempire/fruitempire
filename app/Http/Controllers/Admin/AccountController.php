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
    //管理后台获取不同类别用户
    public function getUsers()
    {
        $type=inputGet('type','');
        return FtUser::getUser($type);
    }

    //更新用户资料
    public function postUpdate()
    {
        if(inputGet('password')){
            $password=getPassword(inputGet('password'));
        }else{
            $password='';
        }
      return  LUser::updateUser(inputGetOrFail('id'),inputGet('nick_name','') , '', '', 0, $password, inputGet('mobile',''),inputGet('state',''));
    }

    public function postAgree()
    {
        $state=FtUser::SECOND_STATE;
        $user=FtUser::find(inputGetOrFail('id'));
       // $group=new \LGroup();
        //$group->setGroupUser(101, $user->unionID);//101表示代理商用户组的ID
        LUser::updateUser(inputGetOrFail('id'),inputGet('nick_name','') , '', '', 0, '', '',$state);
        return;
    }

    

}