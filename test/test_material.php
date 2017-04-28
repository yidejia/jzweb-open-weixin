<?php
include "../vendor/autoload.php";

use jzweb\open\weixin\lib\material;


/**
 * 测试永久素材上传
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/4/27
 */

$material = new material();

$access_token = "iT64X9co3E0dKGCmMrA1Ipijtz2V8uiYm1btFqLkXtB_8fIdXcdi9RD_oy0WyXO6-jiCS2ESkRF3x7t19zAEEDJCahbi0qM9TbflKelDs2WBOc1CrnjZkG7vSf6Qw3eaTSSjAMDBAA";
//$result=$material->getTotal($access_token);
//print_r($result);exit;
//$result=$material->batchget($access_token,"image",0,20);
//print_r($result);exit;
//$result=$material->batchget($access_token,"news",0,20);
//print_r($result);exit;
//$result=$material->get($access_token,"3CoeRU4pt752wWTYAwuTxq83VRX5XUTbCkrotSS7GJU","news");
//print_r($result);exit;
//$result=$material->get($access_token,"3CoeRU4pt752wWTYAwuTxsCkK3YIMI8f7rBEu49TEX4","image","/Users/liusongsen/Project/web/jzweb-open-weixin/test/a");
//var_dump($result);exit;

//$result=$material->delete($access_token,"3CoeRU4pt752wWTYAwuTxnLimz2o5pvZU1N1_H1Fz-g");
//var_dump($result);

//$result =$material->uploadImage($access_token,"/Users/liusongsen/Downloads/28-28.png");
//var_dump($result);exit;
//$result =$material->uploadVoice($access_token,"/Users/liusongsen/Downloads/-data-wwwroot-weiphp-Uploads-Download-2016-12-08-5849019344c84.mp3");
//var_dump($result);exit;
//$result = $material->uploadVideo($access_token, "/Users/liusongsen/Downloads/卡雷测试用_20170419_220900(1).mp4","测试上传");
//var_dump($result);
//exit;

//$result=$material->uploadThumb($access_token,"/Users/liusongsen/Downloads/28-28.png");
//var_dump($result);exit;


//
//$result=$material->uploadNewsImg($access_token,"/Users/liusongsen/Downloads/28-28.png");
//var_dump($result);exit;


$data = array("articles" => array(array(
    "title" => "测试",
    "thumb_media_id" => "3CoeRU4pt752wWTYAwuTxiE7IEY8AU7wq4j1QV0aJkA",
    "author" => "刘松森",
    "digest" => "测试摘要内容处理",
    "show_cover_pic" => 0,
    "content" => "测试我们想说的内容",
    "content_source_url" => "http://www.yidejia.com"
)));
$result = $material->uploadNews($access_token, $data);
var_dump($result);
exit;
