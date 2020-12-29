<?php
/* 
 * @Author: 故乡情
 * @Date: 2020-12-28 18:57:11
 * @LastEditTime: 2020-12-29 15:03:12
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/block.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace epnz;

class block
{
    /**
     * Version
     */
    const VERSION = '0.0.4';

    protected $lang = 'zh-cn';

    public $rootPath;

    public $thisPath;

    public $httpCode;

    public $class;

    public function __construct($paths = [])
    {
        spl_autoload_register(function ($class) {
            $class = ltrim($class, 'epnz\\');
            include $class . '.php';
        });
        
        if(empty($paths)){
            $this->rootPath = dirname(__DIR__);
            //$this->rootPath = dirname(__DIR__, 4);
        } else {
            $this->rootPath = $paths['root'];
        }

        $this->thisPath = __DIR__;

        if(isset($paths['config'])){
            $basic = $paths['config'] . DIRECTORY_SEPARATOR .'basic.php';
            if(file_exists($basic)){
                $basic = require_once $basic;
                $this->lang = $basic['language'];
            }
        }

        $blockLanguagePath = $this->thisPath . DIRECTORY_SEPARATOR 
        . 'language' . DIRECTORY_SEPARATOR . $this->lang . DIRECTORY_SEPARATOR;

        $http = require_once $blockLanguagePath . 'http.php';

        $this->httpCode = $http;
        $this->class = __CLASS__;
        
        // $autoloadFile = ['default'];

        // foreach ($autoloadFile as $v) {
        //     require_once $v . '.php';
        // }
    }
}
