<?php
/**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/4
     * Time: 17:38
     */

namespace app\api\model;

class Image extends Base
{
    /**获取器
     * @author crazy
     * @time 2018-09-05
     */
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImage($value, $data);
    }

    public function getStatusAttr($value)
    {
        $statusTest = [0=>'正常','1'=>'删除','2'=>'禁用'];
        return $statusTest[$value];
        //获取原始数据
        //echo $user->getData('status');
    }

    /**修改器
     * Name是数据库里面的字段
     */
    public function setNameAttr($value)
    {
        return strtolower($value);
    }
}
