<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2018/9/5
     * Time: 9:12
     */

namespace app\index\controller;

use think\Request;

class Upload extends Base
{
    public function viewShow()
    {
        return $this->fetch('viewShow');
    }

    public function viewShowMore()
    {
        return $this->fetch('viewShowMore');
    }

    /**单个图片上传
     * @author crazy
     * @time 2018-09-05
     * @param request 请求类
     */
    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        if ($file) {
            $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
                echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }

    /**多图上传
     * @author crazy
     * @time 2018-09-05
     * @param request 请求类
     */
    public function uploadImageMore(Request $request)
    {
        // 获取表单上传文件
        $files = $request->file('image');
        foreach ($files as $file) {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
                echo $info->getExtension();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
                return;
            }
        }
    }
}
