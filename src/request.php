<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 17:55:15
 * @LastEditTime: 2021-03-12 00:00:07
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/request.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class request
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'curlPost', 'curlGet', 'server', 'cookie', 'session', 'ip'
    ];

    private $requestMethod = [
        'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE'
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

    /**
     * @description: CURL in Get
     * @access  public
     * @param   string  $url    URL
     * @param   array   $param  参数
     * @return  string
     */
    public function curlGet($url, $param = null)
    {
        if (is_array($param)) {
            $param = http_build_query($param);
        } else {
            $param = '';
        }

        if ($param) {
            if (empty(parse_url($url, PHP_URL_QUERY))) {
                $url = $url . '?' . $param;
            } else {
                $url = $url . '&' . $param;
            }
        }

        $header = array(
            'Accept: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //设置头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // 设置请求头
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // 抓取URL并把它传递给浏览器
        $raw = curl_exec($ch);

        // 显示错误信息
        if (curl_error($ch)) {
            return "Error: " . curl_error($ch);
        } else {
            // 关闭cURL资源，并且释放系统资源
            curl_close($ch);
            return $raw;
        }
    }

    /**
     * @description: PHP $_SERVER
     * @param   string  $param  $_SERVER的参数
     * @return  array   如果加参数，输出相应字串
     * @access  public
     */
    public function server($param = '')
    {
        return $param ? $_SERVER[$param] ?? false : $_SERVER;
    }

    /**
     * @description: 获取COOKIE
     * @return  array
     * @access  public
     */
    public function cookie()
    {
        return $_COOKIE ?? null;
    }

    /**
     * @description: 获取SESSION
     * @return  array
     * @access  public
     */
    public function session()
    {
        return $_SESSION ?? null;
    }

    /**
     * @description: 获取客户端真实IP
     * @return  string  IP
     * @access  public
     */
    public function ip()
    {
        if ($this->server('HTTP_CLIENT_IP')) {
            $ip = $this->server('HTTP_CLIENT_IP');
        }
        if ($this->server('HTTP_X_REAL_IP')) {
            $ip = $this->server('HTTP_X_REAL_IP');
        } elseif ($this->server('HTTP_X_FORWARDED_FOR')) {
            $ip = $this->server('HTTP_X_FORWARDED_FOR');
            $ips = explode(',', $ip);
            $ip = $ips[0];
        } elseif ($this->server('REMOTE_ADDR')) {
            $ip = $this->server('REMOTE_ADDR');
        } else {
            $ip = $ip ?? '0.0.0.0';
        }
        return $ip;
    }
}
