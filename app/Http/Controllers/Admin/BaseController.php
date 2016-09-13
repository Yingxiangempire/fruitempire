<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午10:59
 */

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class BaseController extends Controller
{
    public $administer;

    public function __construct($user_id = '')
    {
        if (\Session::get('administer')) {
            $this->administer = \Session::get('administer');
        } else {
            if (!$user_id) {
                throw new Exception("无效管理员");
            } else {
                $administer = Admin::_findOrFail($user_id)->toArray();
                \Session::push('administer', $administer);
                $this->administer = $administer;
            }
        }

    }
}