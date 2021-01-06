<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-02 23:25:13
 * @LastEditTime: 2021-01-06 23:33:20
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/bin/function.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

use block\func;

/**
 * @description: Block 助手函数
 * @return object
 */
if (!function_exists('block')) {
    function block()
    {
        $func = new func();
        return $func;
    }
}

