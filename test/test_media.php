<?php
include "../vendor/autoload.php";

use \jzweb\open\weixin\lib\core\http;
use \jzweb\open\weixin\lib\media;


/**
 * 测试素材上床
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/30
 */


$media=new media();
$result=$media->upload("7O26L-2J7hT4OMjlMfooccW1JXn_UcmLmhGfNoSMTb510YENo2ojB2lYxntMHAmQ31KIsAm-ePsmBCIIOMeodzMxiXtK9A1colhgfNbL6lj14Nk7TtJB__ZrReR5MojkFBEgAGDZVY","image","test.png","http://s1.yidejia.com/images/beauty/index/banner_3.jpg");
print_r($result);
exit;


$result=(new http())->post("https://api.weixin.qq.com/cgi-bin/media/upload?access_token=9gSl72z5Y4tQLvTiO9mLiVogdbBBb4iMFb1IgN1zR-UevgYvn-zrtYv5fxBEEEs-Y5jCDYN_2enLxg8loPM2TwCYS168F0SSmJEkBCyEx7ZH8RDRASAOCkVHINP9isu2UQPhAGDDZY&type=image",[],"",[
    [
        'name'     => '94cd25dc4861.jpg',
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