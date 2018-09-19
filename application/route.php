<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

//Route::rule('api/v2/test', 'api/v2.Test/test');
Route::rule('api/:version/test', 'api/:version.Test/test');

Route::post('api/:version/token', 'api/:version.Token/getToken');


Route::get('api/:version/time', 'api/:version.Time/getTime');


Route::get('index/test', 'index/Test/test');
Route::get('index/login', 'index/Test/login');
