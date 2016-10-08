<?php
namespace App\Logic;
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午4:00
 */
class LMenu
{
    public $wechat;
    public $menu;

    public function __construct()
    {
        $this->wechat = app('wechat');
        $this->menu = $this->wechat->menu;
    }

    public function getList()
    {
        return $this->menu->all();
    }

    public function getSelfList()
    {
        return $this->menu->current();
    }

    public function setMenu($buttons)
    {
        /*$buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];*/
        return $this->menu->add($buttons);
    }

    public function setSelfMenu($buttons,$matchRule)
    {
        /*$matchRule = [
            "group_id"             => "2",
            "sex"                  => "1",
            "country"              => "中国",
            "province"             => "广东",
            "city"                 => "广州",
            "client_platform_type" => "2"
        ];*/
        $this->menu->add($buttons, $matchRule);
    }


    public function delete($menuID)
    {
        return $this->menu->destory($menuID);
    }

}