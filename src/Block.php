<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2021-01-03 13:00:01
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
    const VERSION = '0.0.9';

    /**
     * 默认语言
     */
    private $lang = 'zh-cn';

    private $debug = false;

    private $startTime;


    /**
     * 打造一个全局能用的基础数组
     */
    public $basic;

    public static $config;

    /**
     * @description:  前置操作
     * @param   array $paths
     * @return  null
     */
    public function __construct(array $config = [])
    {
        $this->startTime = microtime(true);
        $this->init($config);
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
    private function init($config = [])
    {
        $this->basic['path']    = __DIR__;
        $this->basic['lang']    = $config['language'] ?? $this->lang;
        $this->basic['debug']   = $config['debug'] ?? $this->debug;

        if (isset($config['config'])) {
            $configFile = $config['config'] . DIRECTORY_SEPARATOR . 'basic.php';
            if (file_exists($configFile)) {
                $configBasic = require_once $configFile;
                $this->basic['lang'] = $configBasic['language'] ?? $this->lang;
            }
        }

        $blockLanguagePath = $this->basic['path'] . DIRECTORY_SEPARATOR
            . 'language' . DIRECTORY_SEPARATOR . $this->basic['lang'] . DIRECTORY_SEPARATOR;

        $this->basic['http_code'] = include $blockLanguagePath . 'http.php';
        if ($this->basic['debug']) {
            register_shutdown_function([$this, 'rsf']);
        }
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
