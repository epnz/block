<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 14:59:57
 * @LastEditTime: 2022-06-16 18:52:08
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: \block\src\character.php
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
        'randChar', 'byteFormat'
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
     * @description: 生成一个唯一ID
     * @param   bool    $trim   是否修饰
     * @return  string
     */
    public function  uuid($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((float)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace .
            substr($charid,  0,  8) . $hyphen .
            substr($charid,  8,  4) . $hyphen .
            substr($charid, 12,  4) . $hyphen .
            substr($charid, 16,  4) . $hyphen .
            substr($charid, 20, 12) .
            $rbrace;
        return $guidv4;
    }
}
