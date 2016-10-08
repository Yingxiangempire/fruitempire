<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/24
 * Time: 上午11:50
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\FtUser;
use Qiniu\Auth;

class BaseInfoController  extends Controller
{
    public function getQiniuToken()
    {
        $accessKey = config('app.qiniu.access_key');
        $secretKey = config('app.qiniu.secret_key');
        $auth = new Auth($accessKey, $secretKey);
        $bucket = config('app.qiniu.bucket');
        $token = $auth->uploadToken($bucket);
        return ["upload_domain" => config('app.qiniu.domain'), 'token' => $token, 'file_name' => sha1(uniqid())];
    }


    public static function getApplyAgent($user_unionID)
    {
        $user=FtUser::getId($user_unionID);
        if(!$user || $user->state>2 ){
            throw new \Exception("无效申请");
        }else{
            $user->state=FtUser::APPLY_STATE;
        }
        $user->save();
        FtUser::cacheForget();
    }
    
}