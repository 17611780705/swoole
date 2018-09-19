<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/5
     * Time: 15:22
     */
namespace app\api\model;

use think\Model;

class Base extends Model
{
    /**定义一个普通的全局方法，拼接图片的url地址*/
    public function prefixImage($value, $data)
    {
        $infoValue = $value;
        if ($data['from'] == 1) {
            return $infoValue = config('setting.prefix_img').$value;
        }
        return $infoValue;
    }
}
