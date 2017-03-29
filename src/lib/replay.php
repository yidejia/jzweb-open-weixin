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
     * @param string $data 消息内容
     *
     * @return string
     */
    public static function replayText($to_user, $from_user, $the_time, $data)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $data . "]]></Content></xml>";
    }

    /**
     * 构建图片回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $data 通过素材管理中的接口上传多媒体文件，得到的id。
     *
     * @return string
     */
    public static function replayImage($to_user, $from_user, $the_time, $data)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[" . $data . "]]></MediaId></Image></xml>";
    }

    /**
     * 构建语音回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string $data 通过素材管理中的接口上传多媒体文件，得到的id。
     *
     * @return string
     */
    public static function replayVoice($to_user, $from_user, $the_time, $data)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[" . $data . "]]></MediaId></Voice></xml>";
    }


    /**
     * 构建视频回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param array $data 回复内容（media_id|title|description) 通过素材管理中的接口上传多媒体文件，得到的id。
     *
     * @return string
     */
    public static function replayVideo($to_user, $from_user, $the_time, $data)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[" . $data['media_id'] . "]]></MediaId><Title><![CDATA[" . $data['title'] . "]]></Title><Description><![CDATA[" . $data['description'] . "]]></Description></Video></xml>";
    }


    /**
     * 构建音乐回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param array $data 回复内容(title|description|music_url|hq_music_url|thumb_media_id)
     *
     * @return string
     */
    public static function replayMusic($to_user, $from_user, $the_time, $data)
    {
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[" . $data['title'] . "]]></Title><Description><![CDATA[" . $data['description'] . "]]></Description><MusicUrl><![CDATA[" . $data['music_url'] . "]]></MusicUrl><HQMusicUrl><![CDATA[" . $data['hq_music_url'] . "]]></HQMusicUrl><ThumbMediaId><![CDATA[" . $data['thumb_media_id'] . "]]></ThumbMediaId></Music></xml>";
    }


    /**
     * 构建图文消息回复消息内容
     *
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param array $data 注意多条图文格式[title|description|pic_url|url]
     *
     * @return string
     */
    public static function replayNews($to_user, $from_user, $the_time, $data)
    {

        $str = "";
        foreach ($data as $article) {
            $str .= "<item><Title><![CDATA[" . $article['title'] . "]]></Title><Description><![CDATA[" . $article['description'] . "]]></Description><PicUrl><![CDATA[" . $article['pic_url'] . "]]></PicUrl><Url><![CDATA[" . $article['url'] . "]]></Url></item>";
        }
        return "<xml><ToUserName><![CDATA[" . $to_user . "]]></ToUserName><FromUserName><![CDATA[" . $from_user . "]]></FromUserName><CreateTime>" . $the_time . "</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>" . count($data) . "</ArticleCount><Articles>" . $str . "</Articles></xml>";
    }

    /**
     * 构建回复消息
     *
     * @param string $type 回复消息类型
     * @param string $to_user 接收方微信用户openid
     * @param string $from_user 开发者微信号
     * @param int $the_time 消息发送时间
     * @param string|array $data 发送的消息内容
     *
     * @return string
     */
    public static function replayMsg($type, $to_user, $from_user, $the_time, $data)
    {

        switch ($type) {
            case "text":
                $result = self::replayText($to_user, $from_user, $the_time, $data);
                break;
            case "image":
                $result = self::replayImage($to_user, $from_user, $the_time, $data);
                break;
            case "voice":
                $result = self::replayVoice($to_user, $from_user, $the_time, $data);
                break;
            case "video":
                $result = self::replayVideo($to_user, $from_user, $the_time, json_decode($data, true));
                break;
            case "music":
                $result = self::replayMusic($to_user, $from_user, $the_time, json_decode($data, true));
                break;
            default:
                $result = self::replayNews($to_user, $from_user, $the_time, json_decode($data, true));
                break;
        }
        return $result;
    }


}
