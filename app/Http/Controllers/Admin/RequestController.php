<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午10:52
 */

namespace App\Http\Controllers\Admin;


use App\Models\FtUser;

class RequestController extends BaseController
{

    public function postAgree()
    {
        $user_id = inputGetOrFail('user_id');
        \LUser::updateUser($user_id,'','','','','','',FtUser::SECOND_STATE);
        //创建后台管理者
        $user=FtUser::_findOrFail($user_id)->toArray();
        \LAccount::setAdmin($user['nick_name'],'','', $user['unionID'], $user['avatar']);
        //转换至二级代理商分组
    }

    public function postReject()
    {
        $user_id = inputGetOrFail('user_id');
        //发送信息给用户被拒绝
    }

}