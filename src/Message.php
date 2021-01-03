<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 05:41:58
 * @LastEditTime: 2021-01-03 01:09:36
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/message.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class message
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'test'
    ];

    public function outPut($param = [], $data = []){
        $toArray = (new json)->jsonToArray($param);
        $param = is_array($toArray) ? $toArray : $param;
        $param['code'] = $param['code'] ?? 200;
        $arr = [
            'code'      => $param['code'],
            'static'    => $param['code'] == 200 ? 'success' : '',
            'msg'       => '成功'
        ];
        if(!empty($data)){
            $arr['data'] = $data;
        }
        print_r($GLOBALS);
        return $arr;
    }

    public function test()
    {
        return 'message test';
    }
}
