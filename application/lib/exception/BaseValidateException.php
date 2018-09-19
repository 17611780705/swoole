<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/3
     * Time: 11:48
     */
namespace app\lib\exception;

class BaseValidateException extends BaseException
{
    public $code = 400;

    public $msg = '参数错误';

    public $errorCode = '10000';
}
