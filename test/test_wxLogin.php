<?php
include "../vendor/autoload.php";

use jzweb\open\weixin\website\wxLogin;

/**
 * 测试微信登录-网站应用
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/3
 */

$app_id = "wx8a144d60548d666d";
$secret = "49d258b8b1d4533dc770ee8c0a9e6f0f";
$wxLogin = new wxLogin($app_id, $secret);

//构造获取code的url
$redirect_url = urlencode("http://u.yidejia.com/index.php?m=ucenter&c=user&a=userLogin");
$url = $wxLogin->getCodeUrl($redirect_url);
echo $url;
//获取微用户登录二维码
$redirect_url = urlencode("http://u.yidejia.com/index.php?m=ucenter&c=user&a=userLogin");
$data = $wxLogin->getQrCode($redirect_url);
print_r($data);
//通过code获取access_token
$code = "sdfsdf";
$data = $wxLogin->getAccessToken($code);
print_r($data);
//获取用户信息
$access_token = "sdfsdf";
$data = $wxLogin->getUser($access_token);
print_r($data);