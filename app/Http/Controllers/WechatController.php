<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;
use Log;


class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');


        $wechat->server->setMessageHandler(function($message) use ($wechat){
            $userService = $wechat->user;

            $openid=$message->FromUserName;
            $user = $userService->get($openid);
            return "wangyuxiang 欢迎你".$openid.$user->nickname;
        });


        Log::info('return response.');

        return $wechat->server->serve();
    }
}