<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-06 17:19:42
 * @LastEditTime: 2021-01-06 22:21:58
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/func.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class func
{
    public function __get($name)
    {
        $class = 'block\\' . $name;
        return (new $class());
    }
}