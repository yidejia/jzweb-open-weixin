<?php
namespace jzweb\open\weixin\lib\entity\message;

/**
 * 微信公众平台-消息-视频消息
 *
 * <xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>1357290913</CreateTime>
 *<MsgType><![CDATA[video]]></MsgType>
 *<MediaId><![CDATA[media_id]]></MediaId>
 *<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
 *<MsgId>1234567890123456</MsgId>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class videoMsg
{
    /**
     * 转换为数组
     *
     * @param array $obj 要转换的对象数组
     * @return array
     */
    public static function toArray($obj)
    {
        return array(
            'the_time' => date("Y-m-d H:i:s"),
            "to_user_name" => $obj['ToUserName'],
            "from_user_name" => $obj['FromUserName'],
            "create_time" => $obj['CreateTime'],
            "msg_type" => $obj['MsgType'],
            "media_id" => $obj['MediaId'],
            "thumb_media_id" => $obj['ThumbMediaId'],
            "msg_id" => $obj['MsgId']
        );
    }
}