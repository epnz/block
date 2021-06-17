<?php
/*
 * @Author: 故乡情
 * @Date: 2021-06-17 10:07:35
 * @LastEditTime: 2021-06-17 12:19:18
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/file.php
 * Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

class file
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'creatDir', 'getImage'
    ];

    /**
     * 函数说明
     * is_dir:判断给定文件名是否是一个目录,如果是返回ture,如果不是返回false
     * dirname:返回路径中的目录部分,本函数返回去掉文件名后的目录名.比如$path="a/b/c";那么dirname($path)="a/b"
     * mkdir:尝试新建一个由 pathname 指定的目录。mkdir(string pathname [,int mode]),默认的 mode 是 0777，意味着最大可能的访问权
     * 解释一下自动创建文件夹:
     * creatdir("a/b/c/d/e/f")//调用创建函数
     * 首先判断整个目录是不是文件夹(或者说是不是存在),如果存在,返回真,则返回,不执行,如果不存在.则继续
     * 不存在,判断其去掉最后目录名的是否存在:creatdir(dirname($path)):调用自身创建函数判断,如果存在则继续,创建$path
     * 如果不存在,则再次去掉最后目录名,继续判断....直到最后判断a,
     * 到了文件所在文件夹,首先判断是否是文件夹,是:返回ture,返回上一级creatdir(dirname($path)),判断/成功,
     * 则创建$path,/a/.mkdir($path,0777);返回真,
     * 再次返回上一级creatdir(dirname($path)),判断/a/成功,则创建/a/b/ .....依次类推.创建,最后返回ture.
     * @param string $path
     * @return boolean
     */
    public function creatDir($path)
    {
        if (!is_dir($path)) {
            if ($this->creatdir(dirname($path))) {
                mkdir($path, 0777);
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     *功能：php完美实现下载远程图片保存到本地
     *参数：文件url,保存文件目录,保存文件名称，使用的下载方式
     *当保存文件名称为空时则使用远程文件原来的名称
     */
    public function getImage($url, $save_dir = '', $filename = '', $type = 0)
    {
        if (trim($url) == '') {
            return array('file_name' => '', 'save_path' => '', 'error' => 1);
        }

        if (trim($save_dir) == '') {
            $save_dir = './';
        }

        if (trim($filename) == '') { //保存文件名
            $ext = strrchr($url, '.');
            if ($ext == '.gif' || $ext == '.jpg' || $ext == '.jpeg' || $ext == '.png') {
                $filename = time() . mt_rand(1000, 9999) . $ext;
            }

            if ($filename == '') {
                //////////////
                $froms = ['jpg', 'gif', 'png', 'jpeg'];
                foreach ($froms as $k => $v) {
                    if (strstr($url, $v)) {
                        $filename = time() . mt_rand(1000, 9999) . '.' . $v;
                        break;
                    }
                }
            }
        }

        if (!$filename) {
            return array('file_name' => '', 'save_path' => '', 'error' => 3);
        }

        if (0 !== strrpos($save_dir, '/')) {
            $save_dir .= '/';
        }
        //创建保存目录
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return array('file_name' => '', 'save_path' => '', 'error' => 5);
        }
        //获取远程文件所采用的方法
        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
        $fp2 = @fopen($save_dir . $filename, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img, $url);
        return array('file_name' => $filename, 'save_path' => $save_dir . $filename, 'error' => 0);
    }
}
