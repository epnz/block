<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2021-01-06 23:31:51
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
    const VERSION = '0.0.13';

    /**
     * 打造一个全局能用的基础数组
     */
    public $basic;

    /**
     * 默认语言
     */
    public $lang = 'zn-cn';

    protected $timezone = 'Asia/Shanghai';

    protected $debug = false;

    protected $startTime;


    private $langs = ['zh-cn', 'en'];

    /**
     * @description:  前置操作
     * @param   array $paths
     * @return  null
     */
    public function __construct()
    {
        $this->startTime = microtime(true);
        date_default_timezone_set($this->timezone);
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
        $this->lang = in_array($this->lang, $this->langs) ? $this->lang : 'zh-cn';
    }

    /**
     * @description: HTTP Code
     * @param   string $lang 显示时的语文
     * @return  array
     * @access  public
     */
    public function getHttpCode()
    {
        $blockLanguagePath = $this->basic['path'] . DIRECTORY_SEPARATOR
            . 'language' . DIRECTORY_SEPARATOR . $this->lang . DIRECTORY_SEPARATOR;
        $httpCode = include $blockLanguagePath . 'http.php';
        return $httpCode;
    }

    /**
     * @description: 获取语言
     * @param   string  $file   语言文件名，不要加后缀
     * @return  array
     * @access  public
     */
    public function getLang($file)
    {
        $blockLanguagePath = $this->basic['path'] . DIRECTORY_SEPARATOR
            . 'language' . DIRECTORY_SEPARATOR . $this->lang . DIRECTORY_SEPARATOR;
        $languages = include $blockLanguagePath . $file . '.php';
        return $languages;
    }

    /**
     * @description: 注册一个 callback ，它会在脚本执行完成或者 exit() 后被调用。
     * @return string
     */
    // public function rsf()
    // {
    //     echo number_format((microtime(true) - $this->startTime), 8, '.', '') . 's';
    // }
}
