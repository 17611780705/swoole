<?php
$http = new swoole_http_server("127.0.0.1", 9501);
$http->set([
    'document_root' => '/home/wwwroot/swoole',
    'enable_static_handler' => true,
]);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start();
