<?php
include "../vendor/autoload.php";

use jzweb\open\weixin\open\mpAuth;

/**
 * 测试公众号第三方平台授权
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
$app_id = "wx619be6018fec9c45";
$secret = "827327a10043c870190b244ad3fcde9a";
$ticket = "ticket@@@_KwChdo7lgVbNKtPmMiFj2GPHLmhxyP2sBS0g9DiGjBrMJj-Lxdb8bfzqgvZIsxiP__K-4sMLHHVZSx9JpIr9w";

$component_access_token = "q7h40kHcmJYSLMA3h0InRVPKvgp6Wrj-INYMejBGqdbrvveEcigV6QrQJMCRm5hqrbdnmoyebq6aIzsobV95eSyUm3LoEugBvoyFEImkamRxdut17RR84AAxFunMR78JJBIdACAYQX";
$pre_auth_code = "preauthcode@@@_8FuDJcsf2srvBTz4ASNMQVKUnYnbZH0jc4oQ58zQy5SyYYmH-66Kyq9g8kZCay7";
$redirect_uri = "http://test.atido.com/wx_auth_callback.php";

$mpAuth = new mpAuth($app_id, $secret);
#第一步：获取第三方平台component_access_token
if (!$component_access_token) {
    $data = $mpAuth->getComponentAccessToken($ticket);
    $component_access_token = $data['component_access_token'];
}
#第二部：第二步：第三方平台获取预授权码(pre_auth_code)
if (!$pre_auth_code) {
    $data = $mpAuth->getPreAuthCode($component_access_token);
    $pre_auth_code = $data['pre_auth_code'];
}
#第三步：引用用户进入授权页
$url = $mpAuth->getComponentloginpageUrl($pre_auth_code, urlencode($redirect_uri));
echo $url . "\n";