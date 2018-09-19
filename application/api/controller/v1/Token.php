<?php
/**
 * Created by PhpStorm.
 * User: simengphp
 * Date: 2018/9/6
 * Time: 14:39
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\TokenService;
use app\api\validate\TokenValidate;
use think\Request;

class Token extends BaseController
{
    public function getToken(Request $request)
    {
        $code = $request->get('code');
        (new TokenValidate())->goCheck();
        $tokenService = new TokenService();
        echo $tokenService->get($code);
    }
}
