<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-02 23:25:13
 * @LastEditTime: 2021-01-06 21:47:10
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/bin/function.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

use block\func;

if (!function_exists('block')) {
    function block()
    {
        $func = new func();
        return $func;
    }
}

