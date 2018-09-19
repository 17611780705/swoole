<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/8/31
     * Time: 15:56
     */

namespace app\api\model;

use think\Db;
use think\Model;

class Test extends Model
{
    protected $table = 'banner';

    /**创建关联模型*/
    public function item()
    {
        return $this->hasMany('banner_item', 'banner_id', 'id');
    }
    public static function getTest($id)
    {
            //return null;
        /**第一种查询*/
        //$ret = Db::query('select * from banner_item where banner_id=?', [$id]);
        /**第二种查询构造器 fetchSql()-> 生存sql语句的方法，用户检测sql语句*/
//        $ret = Db::table('banner_item')->fetchSql()->where('banner_id', '=', 1)->
//        where('img_id', '=', '1')->select();
//        $ret = Db::name('banner_item')->field(['banner_id'=>'b_id','img_id'])->select();
        /**使用闭包的操作方法*/
//        $ret = Db::name('banner_item')->where(function ($query) use ($id) {
//            $query->where('banner_id', '=', 1);
//        })->select();
        /**第三种ORM模型查询*/
//        $ret = self::get($id);
//        dump($ret->toArray());
//        exit();
//        return $ret;
        return self::with(['item','item.image'])->find($id);
    }
}
