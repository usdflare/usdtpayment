<?php

require_once 'config.php';
//用户付款成功后同步跳转处理页面
$sysorderid = $_GET['sysorderid']; //usdflare系统订单号
$orderid = $_GET['orderid']; //商户订单号
$paymoney = $_GET['paymoney']; //实际付款金额>=你的订单金额
$paytime = $_GET['paytime']; //付款时间
$sign = $_GET['sign'];
$cny = $_POST['cny']; //paymoney对应的cny金额
$appid = $config['appid']; //商户的appid
$apikey = $config['api_key']; //apikey


//(appid+apikey+sysorderid+orderid+paymoney+paytime+cny)
$str = hash('sha256',$appid . $apikey . $sysorderid . $orderid . $paymoney . $paytime. $cny);
if ($str != $sign) {
    die("sign error");
} else {
    if ($paymoney >= '你的订单金额getordermoney($orderid)') {
        //你的数据库到帐处理及发货流程，注意多次接收通知不要重复到帐
        $showpage = true;
    }
}

function getHost()
{
    $protocol = 'http';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $protocol = 'https';
    }
    $host = $_SERVER['HTTP_HOST'];
    $url = $protocol . '://' . $host;
    return $url;
}

?>

<? if ($showpage) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Success</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .success-message {
                text-align: center;
                max-width: 80%;
                padding: 20px;
                background: #fff;
                margin: auto;
                border-radius: 5px;
                box-shadow: 0px 0px 10px 0px #000;
            }

            .success-message h1 {
                color: #4CAF50;
                /* green color */
                font-size: 50px;
            }
        </style>
    </head>

    <body>
        <div class="success-message">
            <h1>Payment Successful!</h1>
            <p>感谢您的购买，您的交易已经完成.</p>
            <p><a href="<?= getHost() ?>/query.php?orderid=<?= $orderid ?>" target="_blank">查询订单</a></p>

        </div>
    </body>

    </html>
<? } ?>