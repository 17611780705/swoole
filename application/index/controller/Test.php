<?php
    /**
     * Created by PhpStorm.
     * User: simengphp
     * Date: 2018/9/14
     * Time: 14:35
     */
namespace app\index\controller;

use app\lib\tools\Encrypt;
use think\Request;

class Test extends Base
{

    /**加密格式
     * username=test&password=123&companyName
     * tokenForLogin :z7Vuv26wZoRiStt1udq5Vly7wDOk2sahZDeeUfj2Hv//DGs+i7hkfrfcs5BKRqh9
     */
    public function test1(Request $request)
    {
        $data = $request->param();
        $username = $data['username']??'test';
        $password = $data['password']??'test';
        $companyName = $data['companyName']??'test';

        /**判断请求时间是否超时*/
        if ((time() - strtotime($data['time']??'2018-09-14 18:00:00')) > 5) {
            return '请求失效';
        }
        $param = [
            'username'=>$username,
            'password'=>$password,
            'companyName'=>$companyName,
        ];
        /**转换成要加密的格式*/
        $paramurl = http_build_query($param, '', '&');
        $tokenForLogin = $data['tokenForLogin']??'z7Vuv26wZoRiStt1udq5Vly7wDOk2sahZDeeUfj2Hv//DGs+i7hkfrfcs5BKRqh9';
        $desObj = new Encrypt();
        $test = $paramurl;
        $retEns = $desObj->encrypt($test);
        if (!$this->verify3Des($retEns, $tokenForLogin)) {
            return '验证错误';
        }
        echo '执行其他操作';
        //do something
    }

    public function test()
    {
        $desObj = new Encrypt();
        $url = 'test.incopat.com/doLogin';
        $username = $data['username']??'jnGxTest';
        $password = $data['password']??'123456';
        $companyName = $data['companyName']??'jnGx';
        $tokenForLogin = $desObj->encrypt(date('Y-m-d H'));
        $param = [
            'username'=>$username,
            'password'=>$desObj->encrypt($password),
            'companyName'=>$companyName,
            'tokenForLogin '=>$tokenForLogin,
        ];
        $ret = $this->httpsRequest($url, $param);
        echo $ret;
    }

    public function login()
    {
        $url = 'test.incopat.com/login/checkAlreadyLogin?username='.'jnGxTest.';
        halt($this->httpsRequest($url));
    }


    public function verify3Des($server_3des, $cline_3des)
    {
        if ($server_3des != $cline_3des) {
            return false;
        }
        return true;
    }

    public function httpsRequest($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
