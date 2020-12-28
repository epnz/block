<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2020-12-28 23:19:32
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/block.php
 * @Copyright © 2020 EPNZ.com
 * @但请保留版权信息
 */

namespace epnz;

class block
{
    /**
     * Version
     */
    const VERSION = '0.0.4';

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
     * @description: CURL in POST
     * @access  public
     * @param   string  $url    URL
     * @param   array   $param  参数
     * @return  string
     */
    public function curlPost($url, $param = null)
    {
        if (is_array($param)) {
            $param = http_build_query($param);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

        // 抓取URL并把它传递给浏览器
        $raw = curl_exec($ch);

        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);

        return $raw;
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
