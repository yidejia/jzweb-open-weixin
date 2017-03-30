<?php
include "../vendor/autoload.php";

use \jzweb\open\weixin\lib\core\http;


/**
 * 测试素材上床
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/30
 */

$result=(new http())->post("https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ayNf3QdzsBeTHK8mnf4dXTeT2YAd02isOsav5B2WEKKJMCrx2z4b96Q_qjgZ-LpC-p6iAa1V7pmDqhYBX0fTKigtD0nNMoEiavYK33eGouA-KoNaH21KVW8xfVUyfYYTMGZgALDWQJ&type=image",[],"",[
    [
        'name'     => 'logo.png',
        'contents' => fopen('/Users/liusongsen/Downloads/28-28.png', 'r')
    ]
]);

print_r($result);exit;

$client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ayNf3QdzsBeTHK8mnf4dXTeT2YAd02isOsav5B2WEKKJMCrx2z4b96Q_qjgZ-LpC-p6iAa1V7pmDqhYBX0fTKigtD0nNMoEiavYK33eGouA-KoNaH21KVW8xfVUyfYYTMGZgALDWQJ&type=image', [
    'multipart' => [
        [
            'name'     => 'logo.png',
            'contents' => fopen('/Users/liusongsen/Downloads/28-28.png', 'r')
        ]
    ]
]);
echo $response->getBody()->getContents();