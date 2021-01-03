<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2021-01-03 22:57:43
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/block.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class block
{
    /**
     * Version
     */
    const VERSION = '0.0.10';

    /**
     * 默认语言
     */
    protected $lang = 'zn-cn';

    protected $debug = false;

    protected $startTime;


    /**
     * 打造一个全局能用的基础数组
     */
    public $basic;

    private $langs = ['zh-cn', 'en'];

    /**
     * @description:  前置操作
     * @param   array $paths
     * @return  null
     */
    public function __construct()
    {
        $this->startTime = microtime(true);
        $this->init();
    }

    // /**
    //  * @description: 实现非静态方法
    //  * "..."语法实现支持可变数量的参数列表
    //  */
    // public function __call($method, $parameters)
    // {
    //     if (in_array($method, $this->methods)) {
    //         return $this->$method(...$parameters);
    //     }
    //     return 'No method: ' . $method . PHP_EOL;
    // }

    // /**
    //  * @description: 实现静态方法
    //  */
    // public static function __callStatic($method, $parameters)
    // {
    //     //return call_user_func_array($method, $parameters);
    //     //return call_user_func_array([static::createFacade(), $method], $parameters);
    //     (new static)->$method(...$parameters);
    // }

    /**
     * @description: 初始化
     * @param   array $config
     * @return  null
     */
    final private function init()
    {
        $this->basic['path']    = __DIR__;
        $this->basic['debug']   = $config['debug'] ?? $this->debug;

        // if (isset($config['config'])) {
        //     $configFile = $config['config'] . DIRECTORY_SEPARATOR . 'basic.php';
        //     if (file_exists($configFile)) {
        //         $configBasic = require_once $configFile;
        //     }
        // }
    }

    /**
     * @description: HTTP Code
     * @param   string $lang 显示时的语文
     * @return  array
     * @access  public
     */
    public function getHttpCode($lang)
    {
        $lang = in_array($lang, $this->langs) ? $lang : 'zh-cn';
        $blockLanguagePath = $this->basic['path'] . DIRECTORY_SEPARATOR
            . 'language' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR;
        $httpCode = include $blockLanguagePath . 'http.php';
        return $httpCode;
    }

    /**
     * @description: 注册一个 callback ，它会在脚本执行完成或者 exit() 后被调用。
     * @return string
     */
    public function rsf()
    {
        echo number_format((microtime(true) - $this->startTime), 8, '.', '') . 's';
    }
}
