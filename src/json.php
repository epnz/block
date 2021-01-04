<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-03 00:26:43
 * @LastEditTime: 2021-01-04 17:39:23
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/json.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class json
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'isJson', 'jsonToArray', 'arrayToJson'
    ];

    /**
     * @description: 判断是否为 Json
     * @param   string  $json   json 字符串
     * @param   bool    $option 值为 true 时直接全输出数组
     * @return  mixed   array and bool
     * @access  public
     */
    public function isJson($json, $option = false)
    {
        @$toArray = json_decode($json, true);
        if (json_last_error() == JSON_ERROR_NONE && $option) {
            return $toArray;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @description: Json 转数组
     * 可能有需要直接输出数组的时候
     * @param   string  $json   Json 字符串
     * @return  mixed   array and false
     * @access  public 
     */
    public function jsonToArray($json)
    {
        return $this->isJson($json, true);
    }

    /**
     * @description: 数组转 Json
     * @param   array   $arr
     * @return  string  Json
     * @access  public
     */
    public function arrayToJson($arr)
    {
        return is_array($arr) ? json_encode($arr, JSON_UNESCAPED_UNICODE) : false;
    }
}
