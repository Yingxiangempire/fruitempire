<?php

namespace App\Http\Controllers\Auth;

use App\Models\FtUser;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Request;
use Laravel\Socialite\Facades\Socialite;
//use Weann\Socialite\Facades\Socialite;
use EasyWeChat\Message\Text;

use View;

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
        $oauthUser = Socialite::driver('weixin')->user();
        $user=json_decode($oauthUser,true);
        $re_id=$p_user?$p_user['id']:0;
        \LUser::setUser($user['nick_name'], $user['id'], $user['avatar'], $re_id);
        /******************给分享者发送提醒*********************/

        $wechat = app('wechat');
        $message = new Text(['content' => '成为了您的下级代理商了,您将获得所有与他相关的购买返点!']);
        $result = $wechat->staff->message($message)->to($pid)->send();
        View::addExtension('html','blade');
        return  view('welcome');
    }
}
