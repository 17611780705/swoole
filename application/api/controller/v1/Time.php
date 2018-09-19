<?php
/**
 * Created by PhpStorm.
 * User: simengphp
 * Date: 2018/9/7
 * Time: 9:52
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;

class Time extends BaseController
{
    /**
     * 签名加密为了保证客户端时间和服务器时间一致
     * 加一个客户端获取时间的方法
    */
    public function getTime()
    {
        list($m, $timeStr) = explode(' ', microtime());
        /**这里使用毫秒是为了更加精确的获取请求时间*/
        return $timeStr.ceil($m*1000);
    }
}
