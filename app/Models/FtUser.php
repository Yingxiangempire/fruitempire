<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/9
 * Time: 上午9:26
 */

namespace App\Models;


class FtUser extends User
{
    public $table = "fe_user";
    public $timestamps = true;
    const INIT_PASSWORD = "18fruit";
    const INIT_STATE = 1;
    const APPLY_STATE = 2;
    const LOCK_STATE = -1;
    const SECOND_STATE = 3;

    public static function getUser($state)
    {
        return self::where('state',$state)->get();
    }

}