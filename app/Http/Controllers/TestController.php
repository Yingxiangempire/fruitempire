<?php
/**
 * Created by PhpStorm.
 * User: yuxiangwang
 * Date: 16/9/3
 * Time: 下午2:51
 */

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;



class TestController extends Controller
{
    public function getPhp()
    {
        echo phpinfo();
    }


    public function getPic()
    {
        $img = Image::make(app_path()."/3.jpg");
       // $img->save('public/bar.jpg');
       $img->insert(app_path()."/foo.jpg",'bottom-right',10, 10);
        $img->save(app_path()."/foo2.jpg");
        return $img->response('jpg');
    }

}