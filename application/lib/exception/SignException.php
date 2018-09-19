<?php
    /**
     * Created by PhpStorm.
     * User: simengphp
     * Date: 2018/9/7
     * Time: 17:48
     */

namespace app\lib\exception;

class SignException extends BaseException
{
    public $code = 403;

    public $msg = '权限错误';

    public $errorCode = '10000';
}
