<?php
namespace App\Logic\Wechat;
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午4:27
 */
use Endroid\QrCode\QrCode;
use Intervention\Image\Facades\Image;
class LQr
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

    //产生二维码
    public function getQr($user_id)
    {
        $text=self::WEIXIN_URL_PART1.$user_id.self::WEIXIN_URL_PART2;
        $qrCode = new QrCode();
        $qrCode
            ->setText($text)
            ->setExtension('jpg')
            ->setSize(100)
            ->setPadding(10)
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setErrorCorrection(QrCode::LEVEL_MEDIUM);
        $qrCode->save($this->base_path.self::QR_PREFIX.$user_id.".jpg");
    }

    //生成专属的二维码图片
    public function getSelfQr($user_id,$nick_name)
    {
        $img = Image::make($this->base_path."root.jpg");
        $this->getQr($user_id);
        $img->insert($this->base_path.self::QR_PREFIX.$user_id.".jpg",'bottom-right',110, 180);
        $img->text($nick_name, 100,100, function($font)  {
            $font->file($this->base_path."/lfaxd.ttf");
            $font->size(24);
            $font->color('#fdf6e3');
        });
        $img->save($this->base_path.$user_id.".jpg");
    }

    public function uplaodQr($user_id,$nick_name)
    {
        $material = $this->wechat->material;
        $this->getSelfQr($user_id,$nick_name);
        $result = $material->uploadImage($this->base_path.$user_id.".jpg");
        return json_decode($result,true);
    }

}