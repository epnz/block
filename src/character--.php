<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 14:59:57
 * @LastEditTime: 2021-01-02 23:01:44
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/character.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class character
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'randChar', 'byteFormat', 'test'
    ];

    /**
     * @description: 生成随机定串
     * @param   integer $length 生成字串的长度
     * @return  string
     */
    public function randChar($length = 8)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[mt_rand(0, $max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }

    /**
     * @description: 格式化容量
     * @param   integer $size   原始容量
     * @param   integer $dec    浮点长度
     * @return  string
     */
    public function byteFormat($size, $dec = 2)
    {
        $a = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        return round($size, $dec) . " " . $a[$pos];
    }

    /**
     * @description: 这是一个 Composer autoload file 测试
     * @param   string  $str    可以传入一个字符串
     * @return  string
     */
    public function test($str = '')
    {
        $str = empty($str) ? "这是一个测试，Composer！" : $str;
        $str = $str . PHP_EOL;
        return $str;
    }
}
