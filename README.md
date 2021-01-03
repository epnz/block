EPower Network Zealot Project Block
===================================

EPower Network Zealot 项目的小组件，非业务代码

## 安装

~~~
composer require epnz/block
~~~

## 使用

~~~php
<?php
require __DIR__ . '/vendor/autoload.php'; 
~~~

## 模块

<div style="margin-left: 20px;">

### 文字 `'character'`

<div style="margin-left: 20px;">

#### - **randChar** 得到随机字符串

#### - **byteFormat** 格式化容量

</div>

-----------------------

### 输出 `'export'`

<div style="margin-left: 20px;">

#### - **json** 输出 Json HTTP 页面

</div>

-----------------------

### Json `'json'`

<div style="margin-left: 20px;">

#### - **isJson** 判断是否为 Json

#### - **jsonToArray** Json 转数组

#### - **arrayToJson**  数组转 Json

</div>

-----------------------

### 消息 `'message'`

<div style="margin-left: 20px;">

#### - **outPut** 组装消息数组

</div>

-----------------------

### 请求 `'request'` 

<div style="margin-left: 20px;">

#### - **curlPost** Curl 的 Post 请求

</div>

-----------------------

</div>

## 标准 / 规范

[HTTP 响应代码](https://tools.ietf.org/html/rfc2616)  |
[PHP 标准规范(PSR 中文翻译)](https://www.bookstack.cn/read/PSR%20%e4%b8%ad%e6%96%87%e7%bf%bb%e8%af%91/README.md) . [更多PHP标准规范](https://www.php-fig.org/psr/)

## 版权信息

 * 你可以免费使用源码，或用于二次开发，但请保留版权信息
 * 更多细节参阅 [LICENSE](LICENSE)

Copyright &copy; 2018-2021 [EPNZ.com](http://www.epnz.com) EPower Network Zealot
