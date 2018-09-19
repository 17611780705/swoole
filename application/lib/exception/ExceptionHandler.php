<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/8/31
     * Time: 16:02
     */

namespace app\lib\exception;

use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $error_code;
    private $request_url;

    public function render(\Exception $e)
    {
        $request = Request::instance();
        if ($e instanceof BaseException) {
            $this->msg  = $e->msg;
            $this->error_code = $e->code;
            $this->request_url = $request->url();
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->msg  = 'server error';
                $this->error_code = 500;
                $this->request_url = $request->url();
                $this->recorderError($e);
            }
        }
        $result = [
            'msg'  => $this->msg,
            'error_code' => $this->error_code,
            'request_url' => $request = $request->url()
        ];
        return json($result, $this->code);
    }

    public function recorderError(\Exception $e)
    {
        Log::init([
            'type'  => 'File',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(), 'error');
    }
}
