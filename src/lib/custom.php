<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;

/**
 * 微信公众号客服接口
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/29
 */
class custom
{

    private $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s";

    /**
     * 客服接口---发送消息
     * 注意中文处理：微信接收到的是非unicode编码的utf-8编码
     * 如果不处理，微信得到的消息将会是乱码(中文unicode)
     *
     * @param string $type 发送类型
     * @param string $access_token 调用凭证
     * @param string $openid 要发送的微信用户openid
     * @param array $data 发送
     *
     * @return mixed
     */
    public function send($type, $access_token, $openid, $data)
    {

        switch ($type) {
            case "text":
                $postData = array('touser' => $openid, 'msgtype' => "text", 'text' => array('content' => $data));
                break;
            case "image":
                $postData = array('touser' => $openid, 'msgtype' => "image", 'image' => array('media_id' => $data));
                break;
            case "voice":
                $postData = array('touser' => $openid, 'msgtype' => "voice", 'voice' => array('media_id' => $data));
                break;
            case "video":
                $postData = array('touser' => $openid, 'msgtype' => "video", 'video' => array("media_id" => $data['media_id'], "thumb_media_id" => $data['thumb_media_id'], "title" => $data['title'], "description" => $data['description']));
                break;
            case "music":
                $postData = array('touser' => $openid, 'msgtype' => "music", 'music' => array("title" => $data['title'], "description" => $data['description'], "musicurl" => $data['music_url'], "hqmusicurl" => $data['hq_music_url'], "thumb_media_id" => $data['thumb_media_id']));
                break;
            case "news":
                $articles = array();
                foreach ($data as $v) {
                    $articles[] = array("title" => $v['title'], "description" => $v['description'], "url" => $v['url'], "picurl" => $v['pic_url']);
                }
                $postData = array('touser' => $openid, 'msgtype' => "news", 'news' => array('articles' => $articles));
                break;
            case "mpnews":
                $postData = array('touser' => $openid, 'msgtype' => "mpnews", 'mpnews' => array('media_id' => $data));
                break;
            default:
                $postData = array('touser' => $openid, 'msgtype' => "wxcard", 'wxcard' => array('card_id' => $data));
                break;
        }

        $requestUrl = sprintf($this->url, $access_token);
        return http::post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }
}