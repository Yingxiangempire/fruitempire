<?php

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午4:00
 */
class LMenue
{
    public $wechat;
    public $menue;
    public function __construct()
    {
        $this->wechat = app('wechat');
$this->menue=$this->wechat ->menu;
    }
}