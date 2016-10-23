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
    const FIRST_STATE = 2;
    const LOCK_STATE = -1;
    const SECOND_STATE = 3;

    public static function getUser($state='')
    {
        return $state?self::where('state',$state)->paginate(get_page_size()):self::paginate(get_page_size());
    }
    
    public static function getId($unionID)
    {
        return self::where('unionID',$unionID)->first();
    }

    public static function getSelfUser($pID)
    {
        return self::where('pID',$pID)->where("state",">",0)->paginate(get_page_size());
    }

}