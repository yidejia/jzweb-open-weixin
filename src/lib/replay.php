<?php
namespace jzweb\open\weixin\lib;


/**
 * 微信消息被动回复
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/29
 */
class replay
{

    /**
     * 构建普通文本回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $hte_time 消息发送时间
     * @param string $content 消息内容
     *
     * @return string
     */
    public static function replayText($to_user, $from_user, $the_time, $content)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
    }

    /**
     * 构建图片回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $media_id 通过素材管理中的接口上传多媒体文件，得到的id。
     *
     * @return string
     */
    public static function replayImage($to_user, $from_user, $the_time, $media_id)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[" . $media_id . "]]></MediaId></Image></xml>";
    }

    /**
     * 构建语音回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $media_id 通过素材管理中的接口上传多媒体文件，得到的id。
     *
     * @return string
     */
    public static function replayVoice($to_user, $from_user, $the_time, $media_id)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[" . $media_id . "]]></MediaId></Voice></xml>";
    }


    /**
     * 构建视频回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $media_id 通过素材管理中的接口上传多媒体文件，得到的id。
     * @param string $title 视频消息标题
     * @param string $description 视频消息的描述
     *
     * @return string
     */
    public static function replayVideo($to_user, $from_user, $the_time, $media_id, $title, $description)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[" . $media_id . "]]></MediaId><Title><![CDATA[" . $title . "]]></Title><Description><![CDATA[" . $description . "]]></Description></Video></xml>";
    }


    /**
     * 构建音乐回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $title 音乐标题
     * @param string $description 音乐描述
     * @param string $music_url 音乐链接
     * @param string $hq_music_url 高质量音乐链接，WIFI环境优先使用该链接播放音乐
     * @param string $thumb_media_id 缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id
     *
     * @return string
     */
    public static function replayMusic($to_user, $from_user, $the_time, $title, $description, $music_url, $hq_music_url, $thumb_media_id)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[" . $title . "]]></Title><Description><![CDATA[" . $description . "]]></Description><MusicUrl><![CDATA[" . $music_url . "]]></MusicUrl><HQMusicUrl><![CDATA[" . $hq_music_url . "]]></HQMusicUrl><ThumbMediaId><![CDATA[" . $thumb_media_id . "]]></ThumbMediaId></Music></xml>";
    }


    /**
     * 构建图文消息回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time  消息发送时间
     * @param array $articles 注意多条图文格式[title|description|pic_url|url]
     *
     * @return string
     */
    public static function replayNews($to_user, $from_user, $the_time, $articles)
    {

        $str = "";
        foreach ($articles as $article) {
            $str .= "<item><Title><![CDATA[" . $article['title'] . "]]></Title><Description><![CDATA[" . $article['description'] . "]]></Description><PicUrl><![CDATA[" . $article['pic_url'] . "]]></PicUrl><Url><![CDATA[" . $article['url'] . "]]></Url></item>";
        }
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>" . count($articles) . "</ArticleCount><Articles>" . $str . "</Articles></xml>";
    }


}
