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

}