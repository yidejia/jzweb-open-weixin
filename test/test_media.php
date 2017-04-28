<?php
include "../vendor/autoload.php";

use \jzweb\open\weixin\lib\core\http;
use \jzweb\open\weixin\lib\media;


/**
 * 测试临时素材上传
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/30
 */


$media=new media();
$result=$media->upload("lNc5de32W0uH9jKDXIb_jbc-ro7z_uzfJDUDfW1TfMYqSxkQDsHizoQc_1jQweJpUhREq4gKWy-32Dfovi8s7nTUUiEM1dehaJ_XYgDFZLRZI1KBIZnbk6qKdigmnNtcLURaAGDBKH","image","/Users/liusongsen/Downloads/28-28.png");
print_r($result);
exit;


$result=(new http())->post("https://api.weixin.qq.com/cgi-bin/media/upload?access_token=xfdCTQUjRC80nUasaQnZsbK4EayutdIwwcRbTVW83Uc2Ry7B8GStWxAPpgg4rIhWl2uHi1C8_FDVmVhmbbuoyWg_QuPV_tDcIlVHUKeZ8kBM3nykQuPEONONDTaw57JUAGHiALDLRS&type=image",[],"",[
    [
        'name'     => '94cd25dc4861.jpg',
        'contents' => fopen('/Users/liusongsen/Downloads/28-28.png', 'r')
    ]
]);


print_r($result);exit;

$client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=xfdCTQUjRC80nUasaQnZsbK4EayutdIwwcRbTVW83Uc2Ry7B8GStWxAPpgg4rIhWl2uHi1C8_FDVmVhmbbuoyWg_QuPV_tDcIlVHUKeZ8kBM3nykQuPEONONDTaw57JUAGHiALDLRS&type=image', [
    'multipart' => [
        [
            'name'     => 'logo.png',
            'contents' => fopen('/Users/liusongsen/Downloads/28-28.png', 'r')
        ]
    ]
]);
echo $response->getBody()->getContents();