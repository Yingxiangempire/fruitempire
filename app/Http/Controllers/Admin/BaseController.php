<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午10:59
 */

namespace App\Http\Controllers\Admin;

use App\Models\FtUser;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class BaseController extends Controller
{
    public $administer;

    public function __construct($user_id = '')
    {

        //      if (array_key_exists("member", $_COOKIE)) {
//           $members = json_decode($_COOKIE['member'], true);
//        } else {
//            $members = [];
//        }
//       if (!$members) {
//            $wechat = app('wechat');
//            $response = $wechat->oauth->scopes(['snsapi_login'])->redirect();
//            $response->send();
//        } elseif (!$members['phone'] && !array_key_exists('info', $_GET)) {
//           header("Location:baseinfo/register?user_id=" . $members['id']);
//        } else {
//            if ($members['phone']) {
//               $edition = $this->getSetting($members['edition']);
//               $members += ['edition_info' => $edition];
//           }
//           $this->member = $members;
//        }




        if (array_key_exists("admin",$_COOKIE)) {
            $this->administer = json_decode($_COOKIE['admin'],true);
        } else {
            if (!$user_id) {
                 $wechat = app('wechat');
                 $response = $wechat->oauth->scopes(['snsapi_base'])->redirect();
                 $response->send();
            } else {
                $administer = Admin::find($user_id)->toArray();
                setcookie('admin',json_encode($administer),time()+60*360,'/');
                $this->administer = $administer;
            }
        }

    }

    public function getAdmin(){
        return $this->administer;
    }


}