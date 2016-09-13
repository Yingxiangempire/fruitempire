<?php

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/9
 * Time: 下午3:22
 */
namespace App\Logic\Home;
use App\Models\FtUser;

class LUser
{
    public static function setUser($nick_name, $unionID, $avatar, $pid = 0, $mobile = '', $state = FtUser::INIT_STATE)
    {
        $user = new FtUser();
        $user->nick_name = $nick_name;
        $user->unionID = $unionID;
        $user->avatar = $avatar;
        $user->pID = $pid;
        $user->password = getPassword(md5(FtUser::INIT_PASSWORD));
        $user->mobile = $mobile;
        $user->state = $state;
        $user->save();
    }

    public static function updateUser($id, $nick_name = '', $unionID = '', $avatar = '', $pid = 0, $password = '', $mobile = '', $state = '')
    {
        $user = FtUser::_findOrFail($id);
        if ($nick_name) {
            $user->email = $nick_name;
        }
        if ($unionID) {
            $user->name = $unionID;
        }
        if ($avatar) {
            $user->avatar = $avatar;
        }
        if ($pid) {
            $user->account = $pid;
        }
        if ($password) {
            $user->password = $password;
        }
        if ($mobile) {
            $user->mobile = $mobile;
        }
        if ($state) {
            $user->state = $state;
        }
        $user->save();
    }


}