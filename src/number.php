<?php
/*
 * @Author: 故乡情
 * @Date: 2024-08-25 15:18:07
 * @LastEditTime: 2024-08-25 15:33:05
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: \block\src\number.php
 * Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

use block\block;

class number extends block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'padWithZeros'
    ];

    /**
     * @description: 数字不足时前面补零
     * @param   {int} $number 传入的整数
     * @param   {int} $length 需补零的位数
     * @return  {strong}
     * @access public
     */    
    public function padWithZeros($number, $length = 6)
    {
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }
}
