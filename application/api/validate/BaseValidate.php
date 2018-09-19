<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/8/30
     * Time: 15:43
     */

namespace app\api\validate;

use app\lib\exception\BaseValidateException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $allData = Request::instance()->param();
        if ($this->batch()->check($allData) != true) {
            //dump($this->error);
            throw new BaseValidateException([
                'msg'=>is_array($this->error)? implode(';', $this->error) : $this->error
            ]);
        }
        return true;
    }

    /**上面和require一起定义的一个函数*/
    public function idMust($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && $value) {
            return true;
        } else {
            return $field.'格式错误';
        }
    }

    /**判断空值
     * @author crazy
     * @time 2018-09-06
     */
    public function isEmpty($value, $rule = '', $data = '', $field = '')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }

    /**验证用户提交过来的字段是否是我自己定义的
     * @author crazy
     * @time 2018-09-07
     * @param $arr 接受的参数
     * @return array
     */
    public function getDataRule(array $arr)
    {
        $rule_data = $this->rule;
        $newArray = [];
        foreach ($rule_data as $key => $value) {
            $newArray[$key] = $arr[$key];
        }
        return $newArray;
    }
}
