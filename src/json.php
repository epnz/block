<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-03 00:26:43
 * @LastEditTime: 2021-01-03 00:46:09
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/json.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class json
{
    public function isJson($json, $option = false)
    {
        @$toArray = json_decode($json, true);
        if(json_last_error() == JSON_ERROR_NONE && $option){
            return $toArray;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function jsonToArray($json)
    {
        return $this->isJson($json, true);
    }
}
