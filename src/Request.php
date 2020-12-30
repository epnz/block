<?
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 17:55:15
 * @LastEditTime: 2020-12-30 16:14:27
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/Request.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace epnz;

use epnz\block;

class Request extends Block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'curlPost'
    ];
    
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
}