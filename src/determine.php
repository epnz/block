<?php
/*
 * @Author: 故乡情
 * @Date: 2021-04-25 14:07:17
 * @LastEditTime: 2021-04-25 15:52:13
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/determine.php
 * Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class determine
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'isMobile'
    ];

    /**
     * 检测是否使用手机访问
     * @access public
     * @return bool
     * @access public
     */
    public function isMobile(): bool
    {
        $request = new request();
        
        if ($request->server('HTTP_VIA') && stristr($request->server('HTTP_VIA'), "wap")) {
            return true;
        } elseif ($request->server('HTTP_ACCEPT') && strpos(strtoupper($request->server('HTTP_ACCEPT')), "VND.WAP.WML")) {
            return true;
        } elseif ($request->server('HTTP_X_WAP_PROFILE') || $request->server('HTTP_PROFILE')) {
            return true;
        } elseif ($request->server('HTTP_USER_AGENT') && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $request->server('HTTP_USER_AGENT'))) {
            return true;
        }

        return false;
    }
}
