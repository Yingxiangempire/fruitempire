<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin;
use App\Models\FtUser;
use App\User;
use EasyWeChat\Support\Log;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Request;
use Laravel\Socialite\Facades\Socialite as Soc;
//use Weann\Socialite\Facades\Socialite;
use EasyWeChat\Message\Text;
use App\Logic\Home\LUser;

use View;
use App\Logic\Wechat\LNotice;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function oauth(Request $request)
    {
        return Socialite::driver('weixin')->redirect();
    }

# 微信的回调地址
    public function callback(Request $request)
    {
        /*************************从本地获取分享者的信息*****************************/
        $user_id=Request::all();
        $pid=$user_id['driver'];
        $p_user=FtUser::getId($pid)?FtUser::getId($pid)->toArray():'';
        /********************获取授权用户的信息后创建本地用户*************************/
        $oauthUser = Soc::driver('weixin')->user();
        $user=(array)$oauthUser;
        AccountController::afterQr($user,$p_user);
        /******************给分享者发送提醒*********************/
        $wechat = app('wechat');
        $notice = $wechat->notice;
        $userId = $pid;
        $templateId = '2W3JIuY4cFk9legTh-qgrywdIXnrX6H01UTXoW8HW78';
        $url = 'http://www.yingxiangempire.com/#agent_user';
        $color = '#FF0000';
        $user_name=$user['nickname'];
        $data = array(
            "first"  => "恭喜您,用户[$user_name]已通过扫码加入,",
            "keyword1"   => $user_name,
            "keyword2"  => date('Y-m-d H:i'),
            "remark" => "您将获得所有与他相关的购买返点,感谢您的推荐!",
        );
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
        View::addExtension('html','blade');
        return  view('welcome');
    }
    
    
    public function callback2(Request $request)
    {
        $oauthUser = Soc::driver('weixin')->user();
        $user=(array)$oauthUser;
        $admin=Admin::getName($user['nickname']);
        new BaseController($admin->id);
        $parameter=Request::all();
        if(array_key_exists('second',$parameter)){
            header("Location:http://www.yingxiangempire.com/#agent_user");
        }else{
            header("Location:http://www.yingxiangempire.com/#wait");
        }

    }
}
