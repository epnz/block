<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-02 01:32:32
 * @LastEditTime: 2021-01-02 23:02:07
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/facade.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class facade
{
    /**
     * @description: 实现静态方法
     */
    public static function __callStatic($method, $parameters)
    {
        //print_r(__NAMESPACE__);
        print_r(__CLASS__);
    }
}
