<?php
require_once 'config.php';

//生成一个不重复的订单号
function generateOrderId()
{
    $orderid = date('YmdHis') . rand(100000, 999999);
    return $orderid;
}

$orderid = $_REQUEST['orderid'] ?? generateOrderId();
$type = 'usdt'; //usdt或cny 如果设置成cny网关会自动转换成对应的usdt数量 注意小写
$money = $_REQUEST['money'] ?? 0;

if ($money <= 0) {
    die('订单金额必须大于0');
}

$appid = $config['appid'];
$apikey = $config['api_key'];

$gatewayUrl = $config['gatewayUrl']; //usdflare网关地址

$signstr = $appid . $apikey . $orderid . $money . $type;
$sign = hash('sha256', $signstr);
//构建请求地址
$nativeurl = $gatewayUrl . '?appid=' . $appid . '&orderid=' . $orderid . '&money=' . $money . '&type=' . $type .'&sign=' . $sign;
die(header("Location: $nativeurl"));

