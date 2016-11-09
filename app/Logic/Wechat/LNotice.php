<?php
namespace App\Logic\Wechat;

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午3:54
 */
class LGroup
{
    public $wechat;
    public $group;

    public function __construct()
    {
        $this->wechat = app('wechat');
        $this->group = $this->wechat->user_group;
    }

    public function setGroup($name)
    {
        return $this->group->create($name);
    }

    public function setGroupUser($group_id, $openId)
    {
       return $this->group->moveUser($openId, $group_id);
    }


}