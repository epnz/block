<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-06 17:19:42
 * @LastEditTime: 2021-01-06 23:35:38
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/func.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class func
{
    /**
     * @description: Block 助手函数的实现方法
     * @param   string $name    获取的具体类名称
     * @return  object
     * @access  public
     */
    public function __get($name)
    {
        $class = 'block\\' . $name;
        return (new $class());
    }
}