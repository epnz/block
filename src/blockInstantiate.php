<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-06 17:19:42
 * @LastEditTime: 2021-06-17 11:40:58
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/blockInstantiate.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class blockInstantiate
{
    /**
     * @description: 命名空间
     */
    private $namespace = __NAMESPACE__;

    /**
     * @description: Block 助手函数的实现方法，不带括号
     * @param   string $className    获取的具体类名称
     * @return  object
     * @access  public
     */
    public function __get($className)
    {
        $class = $this->namespace . '\\' . $className;
        return (new $class());
    }

    /**
     * @description: Block 助手函数的实现方法，带括号
     * @param   string  $className  获取的具体类名称
     * @param   array   $parameters 所有参数
     * @return  object
     * @access  public
     */
    public function __call($className, $parameters)
    {
        $class = $this->namespace . '\\' . $className;
        return new $class(...$parameters);
    }
}