<?php
use think\Route;

Route::get('image', 'index/Upload/viewShow');
Route::post('uploadImage', 'index/Upload/uploadImage');

Route::get('imageMore', 'index/Upload/viewShowMore');
Route::post('uploadImageMore', 'index/Upload/uploadImageMore');

Route::get('captcha', 'index/CaptchaShow/captcha');
Route::post('captchaValidate', 'index/CaptchaShow/captchaValidate');
