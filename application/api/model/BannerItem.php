<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/4
     * Time: 17:27
     */
namespace app\api\model;


class BannerItem extends Base
{
    /**隐藏的字段*/
    protected $hidden = ['id', 'img_id', 'banner_id', 'delete_time'];

    public function image()
    {
        /**定义一个相对的关联，也就是上面的关联的关联*/
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
