<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/9
 * Time: 上午9:26
 */

namespace App\Models;


class Admin extends BaseModel
{
    public $table = "fe_administer";
    public $timestamps = true;
    const PASSWORD="18fruit";

    public static function getNamePassword($name,$password)
    {
        return self::where('name',$name)->where('password',$password)->first();
    }
}