<?php

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/9
 * Time: 下午3:22
 */

use App\Models\Admin;

class LAccount
{
    const INIT_PASSWORD = "18fruit";
    const INIT_STATE = 1;

    public static function setAdmin($name, $email, $qq = '', $weixin = '', $avatar = '')
    {
        $administer = new Admin();
        $administer->email = $email;
        $administer->name = $name;
        $administer->account = $email;
        $administer->password = getPassword(md5(self::INIT_PASSWORD));
        $administer->qq = $qq;
        $administer->weixin = $weixin;
        $administer->avatar = $avatar;
        $administer->state = self::INIT_STATE;
        $administer->save();
    }

    public static function updateAdmin($id, $name = '', $email = '', $qq = '', $weixin = '', $avatar = '', $state = '')
    {
        $administer = Admin::_findOrFail($id);
        if ($name) {
            $administer->name = $name;
        }
        if ($email) {
            $administer->email = $email;
        }
        if ($qq) {
            $administer->qq = $qq;
        }
        if ($weixin) {
            $administer->weixin = $weixin;
        }
        if ($avatar) {
            $administer->avatar = $avatar;
        }
        if ($state) {
            $administer->state = $state;
        }
        $administer->save();
    }

}