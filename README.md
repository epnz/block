# EPower Network Zealot Project Block

EPower Network Zealot 项目的小组件，非业务代码

## 安装

~~~
composer require epnz/block
~~~

## 使用

~~~ php
<?php

require __DIR__ . '/vendor/autoload.php'; 

// 请求端IP
// 以下与block()->request()->ip()；是等效的，request() 是为了方便以后若有需要，可以传入参数
block()->request->ip()；

~~~

## 模块

### 文字 `'character'`

#### - **randChar** 得到随机字符串

~~~ php
block()->request->randChar($length)；
~~~

#### - **byteFormat** 格式化容量

~~~ php
block()->request->byteFormat($size, $dec)；
~~~

### 日期 / 时间 `'date'`

#### - **timeComparison** 一个时间戳与当前时间的比较

~~~ php
block()->request->timeComparison($time, $form)；
~~~

### 判断 `'datermine'`

#### - **isMobile** 是否手机访问

~~~ php
block()->request->isMobil()；
~~~

### 输出 `'export'`

#### - **json** 输出 Json HTTP 页面

~~~ php
block()->request->json($param, $code)；
~~~

### Json `'json'`

#### - **isJson** 判断是否为 Json

~~~ php
block()->request->isJson($json, $option)；
~~~

#### - **jsonToArray** Json 转数组

~~~ php
block()->request->jsonToArray($json)；
~~~

#### - **arrayToJson**  数组转 Json

~~~ php
block()->request->arrayToJson($arr)；
~~~

### 消息 `'message'`

#### - **outPut** 组装消息数组

~~~ php
block()->request->outPut($param, $data)；
~~~

### 请求 `'request'` 

#### - **curlPost** Curl 的 Post 请求

~~~ php
block()->request->curlPost($url, $param)；
~~~

#### - **curlGet** Curl 的 Get 请求

~~~ php
block()->request->curlGet($url, $param)；
~~~

#### - **server** $_SERVER 信息优化

~~~ php
block()->request->server($param)；
~~~

#### - **ip** 获取客户端真实IP

~~~ php
block()->request->ip()；
~~~

#### - **agentOs** 判断浏览器代理类型

~~~ php
block()->request->iagentOs($str)；
~~~

## 标准 / 规范

[HTTP 响应代码](https://tools.ietf.org/html/rfc2616)  |
[PHP 标准规范(PSR 中文翻译)](https://www.bookstack.cn/read/PSR%20%e4%b8%ad%e6%96%87%e7%bf%bb%e8%af%91/README.md) . [更多PHP标准规范](https://www.php-fig.org/psr/)

## 版权信息

 * 你可以免费使用源码，或用于二次开发，但请保留版权信息
 * 更多细节参阅 [LICENSE](LICENSE)

Copyright &copy; 2018-2021 [EPNZ.com](http://www.epnz.com) EPower Network Zealot
