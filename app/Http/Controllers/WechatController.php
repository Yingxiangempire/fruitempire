<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;

use Log;
use Endroid\QrCode\QrCode;
use Intervention\Image\Facades\Image;
use EasyWeChat\Message\Image as Im;

class WechatController extends Controller
{

    const QR_PREFIX="qr_";
    const WEIXIN_URL_PART1="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxdde3cbe598010374&redirect_uri=http%3A%2F%2Fwww.yingxiangempire.com%2Fauth%2Fcallback%3Fdriver%3D";
    const WEIXIN_URL_PART2="&response_type=code&scope=snsapi_userinfo&state=zbo8czE7ZkXrKJHppublVT0GHVI8xPUduPjtYoFS&connect_redirect=1#wechat_redirect";
    public $wechat;
    public $base_path;
    public function __construct()
    {
        $this->wechat=app('wechat');
        $this->base_path=base_path('resources/pic/');
    }

    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $userService = $this->wechat->user;
        $this->wechat->server->setMessageHandler(
            function ($message) use ($userService) {
                $openid = $message->FromUserName;
                $user = $userService->get($openid);
                $qr=new \LQr();
                $mediaId=$qr->uplaodQr($openid,$user->nickname);
                $text = new Im(['media_id' => $mediaId['media_id']]);
               // return "wangyuxiang 欢迎你" . $openid . "你的微信号是:" . $user->nickname;
                return $text;
            }
        );
        Log::info('return response.');
        return $this->wechat->server->serve();
    }


   


}