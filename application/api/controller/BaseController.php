<?php
    /**
     * Created by PhpStorm.
     * User: simengphp
     * Date: 2018/9/7
     * Time: 9:53
     */

namespace app\api\controller;

use app\lib\exception\SignException;
use think\Controller;
use think\Request;

class BaseController extends Controller
{
    public function _initialize()
    {
        $this->checkSignAuth();
    }

    /**验证是否是正常的请求*/
    private function checkSignAuth()
    {
        $headers = Request::instance()->header();

        if (empty($headers['sign'])) {
            throw new SignException();
        }

        $is_set_value = cache($headers['sign']);
        $signStr = $this->getSignAction($headers);
        if ((time() - $headers['time']/1000) > config('setting.expire_time')
            | $signStr != $headers['sign'] | $is_set_value == 1) {
            /**我们直接抛出异常，之后会走ExceptionHandler重写render方法进行异常的抛出*/
            throw new SignException();
        }

        /**如果以上都成立，将签名保存在缓存内，保证签名的唯一性，限制使用次数*/
        cache($headers['sign'], 1, config('setting.sign_cache_time'));

        return true;
    }


    /**加密方法 c45292b020cb6249bbfc919286389d3   15363311918121*/
    private function getSignAction($data = [])
    {
        if (empty($data['version']) || empty($data['time'])) {
            return false;
        }

        $str = md5($data['version'].$data['time']);
        return $str;
    }
}
