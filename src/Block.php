<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2021-01-01 04:01:28
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/block.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace epnz;

class Block
{
    /**
     * Version
     */
    const VERSION = '0.0.8';

    /**
     * 默认语言
     */
    protected $lang = 'zh-cn';

    /**
     * 打造一个全局能用的基础数组
     */
    public $basic;

    public $startTime;

    /**
     * @description:  前置操作
     * @param   array $paths
     * @return  null
     */
    public function __construct($config = [])
    {
        $this->startTime = microtime(true);
        $this->basic['path'] = __DIR__;
        $this->basic['lang'] = $config['language'] ?? $this->lang;

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
    }

    /**
     * @description: 实现非静态方法
     * "..."语法实现支持可变数量的参数列表
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, $this->methods)) {
            return $this->$method(...$parameters);
        }
        return 'No method: ' . $method . PHP_EOL;
    }

    /**
     * @description: 实现静态方法
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
}

// 实现方法和文件的自动加载
spl_autoload_register(function ($class) {
    $class = ltrim($class, 'epnz\\');
    $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    if (!file_exists($file)) {
        trigger_error('Trigger a fatal error', E_USER_ERROR);
        exit();
    }
    include_once $file;
});

register_shutdown_function(function ()
{
    $starTime = (new Block)->startTime;
    $endTime = microtime(true);
    $executionTime = number_format(($endTime-$starTime), 6, '.', ''). 's';
    print_r($executionTime);
});
