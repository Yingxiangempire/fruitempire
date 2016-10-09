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
use App\Logic\Wechat\LGroup;

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
        $group=new LGroup();
        $group->setGroupUser(101, $user->unionID);//101表示代理商用户组的ID
        LUser::updateUser(inputGetOrFail('id'),inputGet('nick_name','') , '', '', 0, '', '',$state);
        return;
    }
    //将普通用户升级为一级代理
    public function  postFirstAgent()
    {
        $state=FtUser::SECOND_STATE;
        $user=FtUser::find(inputGetOrFail('id'));
        $group=new LGroup();
        $group->setGroupUser(102, $user->unionID);//102表示一级代理商
        LUser::updateUser(inputGetOrFail('id'),inputGet('nick_name','') , '', '', 0, '', '',$state);
        return;
    }

    //扫码后用户信息处理
    public static function afterQr($user,$p_user)
    {
        $re_id=$p_user?$p_user['id']:0;
        if($p_user['state']==2){//一级代理商
            $state=FtUser::SECOND_STATE;
            $group=new LGroup();
            $group->setGroupUser(101, $user->unionID);
        }else{
            $state=FtUser::INIT_STATE;
        }
        $user=FtUser::getId($user['id']);
        if(!$user) {
            LUser::setUser($user['nickname'], $user['id'], $user['avatar'], $re_id, '', $state);
        }
    }

    

}