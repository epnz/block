<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 05:41:58
 * @LastEditTime: 2021-01-03 22:02:06
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/message.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

use block\block;

class message extends block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'outPut', 'test'
    ];

    /**
     * @description: 组装消息数组
     * param 可以是数组、Json、httpCode 的数字
     * httpCode 请参阅 https://tools.ietf.org/html/rfc2616 [英文]
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
        $lang = $this->lang;

        if (is_int($param)) {
            $code  = $param;
        } elseif (is_string($param)) {
            $msg = is_string($param);
        } else {
            $toArray = (new json)->jsonToArray($param);
            $param = is_array($toArray) ? $toArray : $param;
            $code = isset($param['code']) ? $param['code'] : 400;
            $msg = isset($param['msg']) ? $param['msg'] : null;
        }

        $httpCode = $this->getHttpCode($lang);

        if (!empty($msg)) {
            $code = $code ?? 200;
        } else {
            if (isset($httpCode['code'][$code])) {
                $msg = $httpCode['code'][$code];
            } else {
                $msg = null;
                $code = 400;
            }
            if (!$msg) {
                $msg = $lang == 'zh-cn' ? '未知错误' : 'unknown';
            }
        }

        foreach ($httpCode['status'] as $k => $v) {
            if (in_array($code, $v['codes'])) {
                $status =  $v['char'];
                break;
            } else {
                $status = $httpCode['status'][2]['char'];
            }
        }

        $arr = [
            'code'      => $code,
            'status'    => $status,
            'msg'       => $msg ? $msg : $httpCode['code'][$code]
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
