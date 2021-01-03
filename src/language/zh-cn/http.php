<?php
/*
 * @Author: 故乡情
 * @Date: 2020-12-29 05:12:13
 * @LastEditTime: 2021-01-03 16:51:57
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/language/zh-cn/http.php
 * @Copyright © 2020 EPNZ.com
 * 但请保留版权信息
 */

return [
    'code' => [
        100 => '继续',
        101 => '交换协议',
        200 => '就绪',
        201 => '已创建',
        202 => '已接受',
        203 => 'Non-Authoritative Information',
        204 => '无内容',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => '错误请求',
        401 => '未经授权',
        402 => 'Payment Required',
        403 => '禁止执行',
        404 => '未找到',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => '请求超时',
        409 => '请求冲突',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => '服务器内部错误',
        501 => 'Not Implemented',
        502 => '网关错误',
        503 => 'Service Unavailable',
        504 => '网关超时',
        505 => 'HTTP Version Not Supported',
    ],
    'status' => [
        [
            'codes' => [200, 201, 202, 203, 204],
            'char'   => 'success',
        ],
        [
            'codes' => [100, 101],
            'char'   => 'continue',
        ],
        [
            'codes' => [],
            'char'   => 'error',
        ]
    ]
];
