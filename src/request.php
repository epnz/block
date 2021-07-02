<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 17:55:15
 * @LastEditTime: 2021-07-02 19:09:59
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: \block\src\request.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

use block\block;

class request extends block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'curlPost', 'curlGet', 'server', 'cookie', 'session', 'ip', 'os'
    ];

    private $requestMethod = [
        'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE'
    ];

    /**
     * @description: CURL in POST
     * @access  public
     * @param   string  $url    URL
     * @param   array   $param  参数
     * @param   array   $header  请求头，可以模仿浏览器
     * @param   string  $cookieFile Cookie文件存放路径
     * @return  string
     */
    public function curlPost($url, $param = null, $header = false, $cookieFile = '')
    {
        if (is_array($param)) {
            $param = http_build_query($param);
        }

        // if ($http) {
        //     //构造随机ip
        //     $ip_long = array(
        //         array('607649792', '608174079'), //36.56.0.0-36.63.255.255
        //         array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
        //         array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
        //         array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
        //         array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
        //         array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
        //         array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
        //         array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
        //         array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
        //         array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
        //     );
        //     $rand_key = mt_rand(0, 9);
        //     //模拟http请求header头
        //     $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
        //     $header = array("Connection: Keep-Alive", "Accept: text/html, application/xhtml+xml, */*", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0)", 'CLIENT-IP:' . $ip, 'X-FORWARDED-FOR:' . $ip);
        // }

        if($header === true){
            $header = array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Pragma: no-cache',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36',
                'Connection: keep-alive',
                'Accept-Language: zh-CN,zh;q=0.9,en;q=0.8'
            );
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (is_array($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        if ($cookieFile) {
            $file = new file();
            $file->creatDir(dirname($cookieFile));
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); //存储cookies
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

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
     * @param   string  $cookieFile Cookie文件存放路径
     * @return  string
     */
    public function curlGet($url, $param = null, $cookieFile = '')
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

        // 设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 设置头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // 设置请求头
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($cookieFile) {
            $file = new file();
            $file->creatDir(dirname($cookieFile));
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); //存储cookies
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        }

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

    /**
     * @description: 判断浏览器代理类型
     * @param   string $str
     * @return  string
     * @access  public
     */
    public function agentOs($str)
    {
        $oss = ['Windows', 'Macintosh', 'iPhone', 'Android', 'X11', 'Linux'];
        $spider = [
            'Baiduspider', 'Googlebot', '360Spider', 'Sosospider', 'Yahoo! Slurp China', 'Yahoo!',
            'YoudaoBot', 'YodaoBot', 'Sogou News Spider', 'msnbot', 'msnbot-media', 'bingbot', 'YisouSpider',
            'ia_archiver', 'EasouSpider', 'JikeSpider', 'EtaoSpider', 'YandexBot', 'AhrefsBot', 'ezooms.bot',
            'GRequests', 'python-requests', 'NetcraftSurveyAgent'
        ];
        $framework = ['okhttp'];

        foreach ($oss as $v) {
            if (stripos($str, $v) !== false) {
                if ($v == 'X11') {
                    return 'UNIX';
                }
                return $v;
            }
        }

        foreach ($spider as $v) {
            if (stripos($str, $v) !== false) {
                return 'Spider';
            }
        }

        foreach ($framework as $v) {
            if (stripos($str, $v) !== false) {
                return 'Framework';
            }
        }

        return 'unknown';
    }

    /**
     * @description: 判断浏览器代理端tkwt系统及版本（版本混乱，放弃更新）
     * @param   string $os
     * @param   string $agent
     * @return  string
     * @access  public
     */
    public function agentOsVersion($os, $agent)
    {
        if ($os == 'unknown' || $os == 'Spider') {
            return 'unknown';
        }

        if ($os == 'Windows') {
            if (stripos($agent, 'Windows NT 10.0') !== false) {
                return 'Windows 10';
            }
            if (stripos($agent, 'Windows NT 6.2') !== false) {
                return 'Windows 8';
            }
        }
    }
}
