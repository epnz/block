<?php
/*
 * @Author: 故乡情
 * @Date: 2021-06-17 09:51:39
 * @LastEditTime: 2024-08-25 15:32:13
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: \block\src\tools.php
 * Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class tools
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'getImages'
    ];

    /**
     * @description: 获取文本中所有图片
     * @param   string    $content html 文章内容
     * @param   int       $order 第几张，0全部
     * @return  array
     * @access  public
     */
    public function getImagesUrl($content, $order = 0)
    {
        $pattern = "/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.?]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $content, $match);
        if (!empty($match[1])) {
            if ($order == 0) {
                return $match[1];
            }
            if (!empty($match[1][$order - 1])) {
                return $match[1][$order - 1];
            }
        }
        return [];
    }
}
