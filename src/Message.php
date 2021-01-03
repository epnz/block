<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 05:41:58
 * @LastEditTime: 2021-01-03 13:24:39
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
        'outPut', 'test'
    ];

    /**
     * @description: 输出消息数组
     * param 可以是数组或 Json
     * 键类型：
     * code | number
     * status | string
     * msg | string
     * 以上键没有值或者错误时，系统会自动判断并重新赋值
     * @param   array   $param  消息数组，可以是 Json ，
     * @param   array   $data
     * @return  array
     */
    public function outPut($param = [], $data = [])
    {
        $toArray = (new json)->jsonToArray($param);
        $param = is_array($toArray) ? $toArray : $param;
        $param['code'] = $param['code'] ?? 200;
        $arr = [
            'code'      => $param['code'],
            'static'    => $param['code'] == 200 ? 'success' : '',
            'msg'       => '成功'
        ];
        if (!empty($data)) {
            $arr['data'] = $data;
        }
        return $arr;
    }

    public function test()
    {
        return 'message test';
    }
}
