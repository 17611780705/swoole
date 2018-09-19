<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/8/31
     * Time: 17:02
     */

namespace app\lib\exception;

class TestException extends BaseException
{
    public $code = '2000';

    public $msg = '数据为空';

    public $errorCode = '1000';
}
