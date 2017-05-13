<?php
include "../vendor/autoload.php";

use jzweb\open\weixin\lib\qun;
use jzweb\open\weixin\lib\material;



/**
 * 测试微信群发接口
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/5/12
 */


$access_token = "WTYFLLq7sI5tnT1FN0LvNO3kSXT3d0Q9HTBSq8M--eBz8r0b5rRGoYuGjQgyS1WeCbg0ADrFItwJ7w5Q2ncmZN3uRNR8ZQJl5SBKnmriOKWP5imXg1Iw8K8KGgjy41MeCHJdAKDTYA";
$news_media_id = "3CoeRU4pt752wWTYAwuTxoRRQB8J4W_QlcF6Wqs4OBo";
$image_meida_id = "3CoeRU4pt752wWTYAwuTxrNgjGkQt_afK8q14WLEk88";
$video_media_id = "3CoeRU4pt752wWTYAwuTxofFhUmbJUTwSgtekr6-EKI";
$voice_media_id="3CoeRU4pt752wWTYAwuTxofFhUmbJUTwSgtekr6-EKI";

//群发客户端
$qun = new qun();
$material = new material();

//经测试，目前只有永久图片+文本素材可以直接使用，其他素材必须先转化成：对应的临时素材


//预览群发
$result = $qun->preview($access_token, "ogpoIwaTtWlMawW0D_j4_t_2Eas4", "image", $image_meida_id);
var_dump($result);
exit;
//
//$result=$material->get($access_token,$news_media_id,"news");
//var_dump($result);exit;

//测试群发->tag_id
$result = $qun->sendAll($access_token, true, 0, "news", $news_media_id);
var_dump($result);
exit;
//测试群发->open_id
$result = $qun->send($access_token, array(), "news", "");
var_dump($result);
exit;
//删除群发
$result = $qun->delete($access_token, $msg_id, $article_ids);
var_dump($result);
exit;
//获取群发结果
$result = $qun->get($access_token, $msg_id);
var_dump($result);
exit;