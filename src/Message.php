<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 05:41:58
 * @LastEditTime: 2020-12-30 14:40:33
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/Message.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace epnz;

use epnz\Block;

class Message extends Block
{
    protected $methods = [
        'test'
    ];
    
    protected function test()
    {
        return '--MSG--' . PHP_EOL;
    }
}
