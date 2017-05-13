<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;

/**
 * 群发接口和原创校验
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/5/12
 */
class qun
{

    private $url_add_news_imgs = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s";
    private $url_uploadnews = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=%s";
    private $url_uploadvideo = "https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=%s";
    private $url_send = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=%s";
    private $url_sendall = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=%s";
    private $url_get = "https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=%s";
    private $url_preview = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=%s";
    private $url_delete = "https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=%s";


    /**
     * 上传图文消息内的图片获取URL
     * 本接口所上传的图片不占用公众号的素材库中图片数量的5000个的限制。图片仅支持jpg/png格式，大小必须在1MB以下。
     *
     *
     * 返回数据实例：
     * {
     *      "url":  "http://mmbiz.qpic.cn/mmbiz/gLO17UPS6FS2xsypf378iaNhWacZ1G1UplZYWEYfwvuU6Ont96b1roYsCNFwaRrSaKTPCUdBK9DgEHicsKwWCBRQ/0"
     * }
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     * @return array
     */
    public function uploadNewsImg($access_token, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_news_imgs, $access_token);
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }

    /**
     * 上传图文消息素材【订阅号与服务号认证后均可用】
     *
     * {
     *  "articles": [
     *      {
     *          "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
     *          "author":"xxx",
     *          "title":"Happy Day",
     *          "content_source_url":"www.qq.com",
     *          "content":"content",
     *          "digest":"digest",
     *          "show_cover_pic":1
     *      },
     *      {
     *          "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
     *          "author":"xxx",
     *          "title":"Happy Day",
     *          "content_source_url":"www.qq.com",
     *          "content":"content",
     *          "digest":"digest",
     *          "show_cover_pic":0
     *      }
     *   ]
     * }
     *
     * 返回数据实例：
     *
     * {
     *      "type":"news",
     *      "media_id":"CsEf3ldqkAYJAU6EJeIkStVDSvffUJ54vqbThMgplD-VJXXof6ctX5fI6-aYyUiQ",
     *      "created_at":1391857799
     * }
     *
     * @param string $access_token
     * @param array $articles
     * @return array
     */
    public function uploadNews($access_token, $articles)
    {
        $requestUrl = sprintf($this->url_uploadnews, $access_token);
        return http::post($requestUrl, [], json_encode($articles, JSON_UNESCAPED_UNICODE));
    }


    /**
     * 转换视频素材id
     * 请注意，此处视频的media_id需通过POST请求到下述接口特别地得到：https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=ACCESS_TOKEN POST数据如下（此处media_id需通过基础支持中的上传下载多媒体文件来得到）：
     *
     * 返回数据实例：
     *
     * {
     *  "type":"video",
     *  "media_id":"IhdaAQXuvJtGzwwc0abfXnzeezfO0NgPK6AQYShD8RQYMTtfzbLdBIQkQziv2XJc",
     *  "created_at":1398848981
     * }
     *
     * @param string $access_token
     * @param string $media_id
     * @param string $title
     * @param string $description
     * @return core\mix
     */
    public function uploadVideo($access_token, $media_id, $title, $description)
    {
        $requestUrl = sprintf($this->url_uploadvideo, $access_token);
        $postData = array("media_id" => $media_id, "title" => $title, "description" => $description);
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }


    /**
     * 查看群发消息发送状态
     * 订阅号与服务好认证后均可使用
     *
     * 返回数据实例：
     *
     * {
     *      "msg_id":201053012,
     *      "msg_status":"SEND_SUCCESS"
     * }
     *
     * @param string $access_token
     * @param string $msg_id
     * @return array
     */
    public function get($access_token, $msg_id)
    {
        $requestUrl = sprintf($this->url_get, $access_token);
        $postData = array("msg_id" => $msg_id,);
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }


    /**
     * 群发接口图文消息-永久图文素材转换
     *
     * @param string $access_token
     * @param array $data
     * @return array
     */
    public function transNewsFromMaterialNews($access_token, $data)
    {
        foreach ($data as $k => $v) {
            $thumb_info = (new media())->upload($access_token, "thumb", $v['thumb']['url_local_file']);
            if (isset($thumb_info['code'])) {
                return $thumb_info;
            }
            $data[$k] = array(
                "title" => $v['title'],
                "thumb_media_id" => $thumb_info['thumb_media_id'],
                "author" => $v['author'],
                "digest" => $v['digest'],
                "show_cover_pic" => $v['show_cover_pic'],
                "content" => $v['content'],
                "content_source_url" => $v['content_source_url']
            );
        }
        //新增群发图文素材
        return $this->uploadNews($access_token, array('articles' => $data));
    }


    /**
     * 群发接口图文消息-永久视频素材转换
     *
     * @param string $access_token
     * @param array $data
     *
     * @return array
     */
    public function transVideoFromMaterialVideo($access_token, $data)
    {
        $video_info = (new media())->upload($access_token, "video", $data['url_local_file']);
        if (isset($video_info['code'])) {
            return $video_info;
        }
        //转换群发视频素材
        return $this->uploadVideo($access_token, $video_info['media_id'], $data['title'], $data['introduction']);
    }


    /**
     * 根据标签进行群发【订阅号与服务号认证后均可用】
     *
     * 视频素材特殊处理：先转化视频素材然后conent为结构数组
     * {
     *  "filter":{
     *  "is_to_all":false,
     *  "tag_id":2
     * },
     *  "mpvideo":{
     *      "media_id":"IhdaAQXuvJtGzwwc0abfXnzeezfO0NgPK6AQYShD8RQYMTtfzbLdBIQkQziv2XJc"
     *      "title":"TITLE",
     *      "description":"DESCRIPTION"
     *      "thumb_media_id":"THUMB_MEDIA_ID"
     *  },
     *  "msgtype":"mpvideo"
     * }
     *
     * 返回数据实例：
     *
     * {
     *      "errcode":0,
     *      "errmsg":"send job submission success",
     *      "msg_id":34182,
     *      "msg_data_id": 206227730
     * }
     *
     * @param string $access_token
     * @param bool $is_to_all
     * @param int $tag_id
     * @param $msg_type
     * @param $content
     * @return core\mix
     */
    public function sendAll($access_token, $is_to_all = true, $tag_id = 0, $msg_type, $content, $send_ignore_reprint = 0)
    {
        $requestUrl = sprintf($this->url_sendall, $access_token);
        if ($msg_type == "text") {
            $postData = array("filter" => array('is_to_all' => $is_to_all, 'tag_id' => $tag_id), "text" => array('content' => $content), 'msgtype' => "text", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "wxcard") {
            $postData = array("filter" => array('is_to_all' => $is_to_all, 'tag_id' => $tag_id), "wxcard" => array('card_id' => $content), 'msgtype' => "wxcard", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "video") {
            //todo 组装数据 是否支持视频缩略图的媒体ID thumb_media_id???
            $postData = array("filter" => array('is_to_all' => $is_to_all, 'tag_id' => $tag_id), "mpvideo" => array('media_id' => $content['media_id'], 'title' => $content['title'], 'description' => $content['description']), 'msgtype' => "mpvideo", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "news") {
            $postData = array("filter" => array('is_to_all' => $is_to_all, 'tag_id' => $tag_id), "mpnews" => array('media_id' => $content), 'msgtype' => "mpnews", 'send_ignore_reprint' => $send_ignore_reprint);
        } else {
            $postData = array("filter" => array('is_to_all' => $is_to_all, 'tag_id' => $tag_id), $msg_type => array('media_id' => $content), 'msgtype' => $msg_type, 'send_ignore_reprint' => $send_ignore_reprint);
        }
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }


    /**
     * 根据OpenID列表群发【订阅号不可用，服务号认证后可用】
     *
     * 视频素材特殊处理：先转化视频素材然后conent为结构数组
     *
     * {
     *  "touser":[
     *  "OPENID1",
     *  "OPENID2"
     * ],
     *  "mpvideo":{
     *      "media_id":"123dsdajkasd231jhksad",
     *      "title":"TITLE",
     *      "description":"DESCRIPTION"
     *      "thumb_media_id":"THUMB_MEDIA_ID"
     * },
     *  "msgtype":"mpvideo"
     * }
     *
     * 返回数据实例：
     *
     * {
     *      "errcode":0,
     *      "errmsg":"send job submission success",
     *      "msg_id":34182,
     *      "msg_data_id": 206227730
     * }
     *
     * @param string $access_token
     * @param array $to_user
     * @param string $msg_type
     * @param string $content
     * @param int $send_ignore_reprint
     * @return array
     */
    public function send($access_token, $to_user, $msg_type, $content, $send_ignore_reprint = 0)
    {
        $requestUrl = sprintf($this->url_send, $access_token);
        if ($msg_type == "text") {
            $postData = array("touser" => $to_user, "text" => array('content' => $content), 'msgtype' => "text", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "wxcard") {
            $postData = array("touser" => $to_user, "wxcard" => array('card_id' => $content), 'msgtype' => "wxcard", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "video") {
            //todo 组装数据 是否支持视频缩略图的媒体ID thumb_media_id???
            $postData = array("touser" => $to_user, "mpvideo" => array('media_id' => $content['media_id'], 'title' => $content['title'], 'description' => $content['description']), 'msgtype' => "mpvideo", 'send_ignore_reprint' => $send_ignore_reprint);
        } elseif ($msg_type == "news") {
            $postData = array("touser" => $to_user, "mpnews" => array('media_id' => $content), 'msgtype' => "mpnews", 'send_ignore_reprint' => $send_ignore_reprint);
        } else {
            $postData = array("touser" => $to_user, $msg_type => array('media_id' => $content), 'msgtype' => $msg_type, 'send_ignore_reprint' => $send_ignore_reprint);
        }
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }

    /**
     * 开发者可通过该接口发送消息给指定用户，在手机端查看消息的样式和排版。
     * 为了满足第三方平台开发者的需求，在保留对openID预览能力的同时，增加了对指定微信号发送预览的能力，但该能力每日调用次数有限制（100次），请勿滥用。
     *
     * 卡券素材特殊处理：内容为数组
     *
     * { "touser":"OPENID",
     *  "wxcard":{
     *  "card_id":"123dsdajkasd231jhksad",
     *  "card_ext": "{\"code\":\"\",\"openid\":\"\",\"timestamp\":\"1402057159\",\"signature\":\"017bb17407c8e0058a66d72dcc61632b70f511ad\"}"
     *  },
     *  "msgtype":"wxcard"
     *  }
     *
     * 返回数据实例：
     *
     * {
     *      "errcode":0,
     *      "errmsg":"preview success",
     *      "msg_id":34182
     * }
     *
     * @param string $access_token
     * @param string $to_user
     * @param string $msg_type
     * @param string $content
     * @param bool $flag touser或者towxname二选一
     * @return array
     */
    public function preview($access_token, $to_user, $msg_type, $content, $flag = false)
    {

        $requestUrl = sprintf($this->url_preview, $access_token);
        if ($msg_type == "text") {
            $postData = array(($flag ? "towxname" : "touser") => $to_user, "text" => array('content' => $content), 'msgtype' => "text");
        } elseif ($msg_type == "wxcard") {
            $postData = array(($flag ? "towxname" : "touser") => $to_user, "wxcard" => $content, 'msgtype' => "wxcard");
        } elseif ($msg_type == "video") {
            $postData = array(($flag ? "towxname" : "touser") => $to_user, "mpvideo" => array('media_id' => $content), 'msgtype' => "mpvideo");
        } elseif ($msg_type == "news") {
            $postData = array(($flag ? "towxname" : "touser") => $to_user, "mpnews" => array('media_id' => $content), 'msgtype' => "mpnews");
        } else {
            $postData = array(($flag ? "towxname" : "touser") => $to_user, $msg_type => array('media_id' => $content), 'msgtype' => $msg_type);
        }
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }

    /**
     * 群发之后，随时可以通过该接口删除群发。
     *
     * 1、只有已经发送成功的消息才能删除
     * 2、删除消息是将消息的图文详情页失效，已经收到的用户，还是能在其本地看到消息卡片。
     * 3、删除群发消息只能删除图文消息和视频消息，其他类型的消息一经发送，无法删除。
     * 4、如果多次群发发送的是一个图文消息，那么删除其中一次群发，就会删除掉这个图文消息也，导致所有群发都失效
     *
     * 返回数据实例：
     *
     * {
     *      "errcode":0,
     *      "errmsg":"ok"
     * }
     *
     * @param string $access_token
     * @param string $msg_id
     * @param int $article_ids
     * @return array
     */
    public function delete($access_token, $msg_id, $article_ids = 0)
    {
        $requestUrl = sprintf($this->url_delete, $access_token);
        $postData = array("msg_id" => $msg_id, 'article_idx' => $article_ids);
        return (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
    }
}
