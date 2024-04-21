<?php
require_once 'config.php';
//用户支付成功后系统后台自动以POST方式通知此页面(商户后台设置的notify_url)

$sysorderid = $_POST['sysorderid']; //usdflare系统订单号
$orderid = $_POST['orderid']; //商户订单号
$paymoney = $_POST['paymoney']; //付款金额
$cny = $_POST['cny']; //付款金额usdt数量对应的cny金额 如提交订单时type设置为cny，则以此金额处理本地
$paytime = $_POST['paytime']; //付款时间
$sign = $_POST['sign']; //签名
$appid = $config['appid']; //商户appid
$apikey = $config['api_key'];//apikey



$str = hash('sha256', $appid . $apikey . $sysorderid . $orderid . $paymoney . $paytime . $cny);
if ($str != $sign) {
    die("sign error");
} else {
    echo "success";
    /*
    if ($paymoney >= '你的订单金额') {
        try {
            //调用你的数据库到帐处理及发货流程注意多次接收通知不要重复到帐
            // your code

            echo "success"; //处理成功后必须返回小写success并且无任何其他字符，告诉网关不再重复通知此地址
        } catch (\Throwable $th) {
            echo $th->getMessage(); 
        }
    }
    */
}
