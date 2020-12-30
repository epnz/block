<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2020-12-30 16:09:20
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
    const VERSION = '0.0.7';

    protected $lang = 'zh-cn';

    public $rootPath;

    public $thisPath;

    public $httpCode;

    public $class;

    /**
     * @description:  前置操作
     * @param   array $paths
     * @return  null
     */
    public function __construct($paths = [])
    {
        if (empty($paths)) {
            $this->rootPath = dirname(__DIR__);
            //$this->rootPath = dirname(__DIR__, 4);
        } else {
            $this->rootPath = $paths['root'];
        }

        $this->thisPath = __DIR__;

        if (isset($paths['config'])) {
            $basic = $paths['config'] . DIRECTORY_SEPARATOR . 'basic.php';
            if (file_exists($basic)) {
                $basic = require_once $basic;
                $this->lang = $basic['language'];
            }
        }

        $blockLanguagePath = $this->thisPath . DIRECTORY_SEPARATOR
            . 'language' . DIRECTORY_SEPARATOR . $this->lang . DIRECTORY_SEPARATOR;

        $http = require_once $blockLanguagePath . 'http.php';

        $this->httpCode = $http;
        $this->class = __CLASS__;
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
