<?php
/**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/5
     * Time: 10:16
     */
namespace app\index\controller;

use think\captcha\Captcha;
use think\Request;

class CaptchaShow extends Base
{
    public function captcha()
    {
        return $this->fetch('captcha');
    }

    public function verify()
    {
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    14,
            // 验证码位数
            'length'      =>    3,
            // 关闭验证码杂点
            'useNoise'    =>    true,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    public function captchaValidate(Request $request)
    {
        $data = $request->post('captcha');
        if (!captcha_check($data)) {
            //验证失败
            echo '验证码错误';
        } else {
            echo '正确';
        }
    }
}
