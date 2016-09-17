<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Endroid\QrCode\QrCode;


class TestController extends Controller
{
    public function getPhp()
    {
        echo phpinfo();
    }


    public function getPic()
    {
        $base_path = base_path('resources/pic/');
        $img = Image::make($base_path . "root.jpg");
        // $img->save('public/bar.jpg');
        $img->insert($base_path . "qr.jpg", 'bottom-right', 110, 180);
        $img->save(app_path() . "/foo2.jpg");
        $img->text(
            'www', 100, 100, function ($font) use ($base_path) {
            $font->file($base_path . "/lfaxd.ttf");
            $font->size(24);
            $font->color('#fdf6e3');
        }
        );
        $img->save($base_path . "/foo2.jpg");
        return $img->response('jpg');
    }

    public function getQr()
    {
        $text = "dddddddddddddddd";
        //  $type = inputGet('type', 'png');
        //  $size = inputGet('size', 100);
        $qrCode = new QrCode();
        $qrCode
            ->setText($text)
            ->setExtension('png')
            ->setSize(100)
            ->setPadding(10)
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setErrorCorrection(QrCode::LEVEL_MEDIUM);
        $qrCode->save(app_path() . "/qr.jpg");

    }


    public function getW()
    {
        $s = inputGetOrFail('input');
        return $s;
    }


    public function getMenus()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;
        return $menus = $menu->all();
    }

    public function getAddMenu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key" => "V1001_TODAY_MUSIC"
            ],
            [
                "name" => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        return $menu->add($buttons);

    }


    public function getDelMenu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;
        return $menu->destroy();
    }

    public function getGroup()
    {
        $wechat = app('wechat');
        $group = $wechat->user_group;
        return $group->lists();
    }

}