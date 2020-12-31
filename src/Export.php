<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-31 04:21:42
 * @LastEditTime: 2020-12-31 04:27:30
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/Export.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace epnz;

use epnz\Block;

class Export extends Block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'test'
    ];
    
    protected function test()
    {
        echo 'EXPORT';
    }
}
