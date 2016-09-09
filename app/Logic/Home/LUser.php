<?php

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/9
 * Time: 下午3:22
 */

use App\Models\FtUser;

class LUser
{
    const INIT_PASSWORD = "18fruit";
    const INIT_STATE = 1;

    public static function setUser($nick_name, $unionID, $avatar, $pid = 0, $mobile = '', $state = self::INIT_STATE)
    {
        $user = new FtUser();
        $user->email = $nick_name;
        $user->name = $unionID;
        $user->avatar = $avatar;
        $user->account = $pid;
        $user->password = getPassword(md5(self::INIT_PASSWORD));
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
        $administer->save();
    }


}