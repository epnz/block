<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-31 04:21:42
 * @LastEditTime: 2021-01-03 22:54:14
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/export.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

use block\block;

class export extends block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'json'
    ];

    /**
     * @description: 输出打印 Json
     * $httpCode 以及 $arr 数组或Json中的'code'，会影响输出
     * httpCode 请参阅 https://tools.ietf.org/html/rfc2616 [英文]
     * @param   array   $arr        可以输入Json
     * @param   integer $httpCode   非必填，默认 200
     * @return  直接打印
     * @access  public
     */
    public function json($param, $code = 200)
    {
        header('content-type:application/json');
        $lang = 'en';

        $json = new json();

        if(!is_array($param)){
            $param = $json->jsonToArray($param);
        }

        if(empty($param)) return '[]';

        $code = isset($param['code']) ? $param['code'] : $code;

        $httpCode = $this->getHttpCode($lang)['code'];
        $headerHTTP = isset($httpCode[$code]) ? $code . ' ' . $httpCode[$code] : '200 OK';
        Header('HTTP/1.1 ' . $headerHTTP);
        
        echo $json->arrayToJson($param);
    }

    protected function test()
    {
        echo 'EXPORT' . PHP_EOL;
    }
}
