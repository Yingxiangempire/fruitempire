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
                "name" => "我的商城",
                "url" => "http://www.yingxiangempire.com/mobile"
            ],
            [
                "name" => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url" => "http://www.yingxiangempire.com/order"
                    ],
                    [
                        "type" => "view",
                        "name" => "关于我们",
                        "url" => "http://www.yingxiangempire.com/about"
                    ],
                    [
                        "type" => "view",
                        "name" => "客服联系",
                        "url" => "http://www.yingxiangempire.com/link"
                    ],
                ]
            ]
        ];
        return $menu->add($buttons);

    }

    public function getAddSelfMenu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $buttons = [
            [
                "type" => "click",
                "name" => "获取二维码",
                "key" => "EVENT_KEY_QR"
            ],
            [
                "name" => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url" => "http://www.yingxiangempire.com/order"
                    ],
                    [
                        "type" => "view",
                        "name" => "我的下级",
                        "url" => "http://www.yingxiangempire.com/second"
                    ],
                    [
                        "type" => "view",
                        "name" => "关于我们",
                        "url" => "http://www.yingxiangempire.com/about"
                    ],
                    [
                        "type" => "view",
                        "name" => "客服联系",
                        "url" => "http://www.yingxiangempire.com/link"
                    ],
                ]
            ]
        ];
        $matchRule = [
            "group_id" => "101",
        ];
        $menu->add($buttons, $matchRule);
    }

    public function getAddSelf2Menu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $buttons = [
            [
                "type" => "click",
                "name" => "获取二维码",
                "key" => "EVENT_KEY_QR"
            ],
            [
                "name" => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "我的订单",
                        "url" => "http://www.yingxiangempire.com/order"
                    ],
                    [
                        "type" => "view",
                        "name" => "我的下级",
                        "url" => "http://www.yingxiangempire.com/second"
                    ],
                    [
                        "type" => "view",
                        "name" => "关于我们",
                        "url" => "http://www.yingxiangempire.com/about"
                    ],
                    [
                        "type" => "view",
                        "name" => "客服联系",
                        "url" => "http://www.yingxiangempire.com/link"
                    ],
                ]
            ]
        ];
        $matchRule = [
            "group_id" => "101",
        ];
        $menu->add($buttons, $matchRule);
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