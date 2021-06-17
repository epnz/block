<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-02 23:25:13
 * @LastEditTime: 2021-06-17 11:45:09
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/bin/function.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

use block\blockInstantiate;

/**
 * @description: Block 助手函数
 * @return object
 */
if (!function_exists('block')) {
    function block()
    {
        $instantiate = new blockInstantiate();
        return $instantiate;
    }
}

