<?php
namespace App\Logic\Wechat;

/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/12
 * Time: 下午3:54
 */
class LNotice
{
    public $wechat;
    public $notice;

    public function __construct()
    {
        $this->wechat = app('wechat');
        $this->notice = $this->wechat->notice;
    }

    public function setIndustry($industryId1, $industryId2)
    {
        return $this->notice->setIndustry($industryId1, $industryId2);
    }

    public function getIndustry()
    {
       return $this->notice->getIndustry();
    }

    public function addTemplate()
    {
        return $this->notice->addTemplate();
    }

    public function send($message)
    {
        return $this->notice->send($message);
    }

    public function getPrivateTemplates()
    {
        return $this->notice->getPrivateTemplates();
    }

    public function deletePrivateTemplate($templateId)
    {
        return $this->notice->deletePrivateTemplate($templateId);
    }


}