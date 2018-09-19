<?php
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdMustValidate;
use app\api\model\Test as testModel;
use app\lib\exception\TestException as TestException;
use think\Request;

class Test extends BaseController
{
    public function test(Request $request)
    {
        (new IdMustValidate())->goCheck();
        $id = $request->get('id');
        $ret = testModel::getTest($id);
        if (!$ret) {
            throw new TestException();
        }
        return json($ret);
    }
}
