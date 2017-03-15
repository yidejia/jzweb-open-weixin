<?php
namespace jzweb\open\weixin\lib\entity\message;

/**
 * 微信公众平台-消息-图片消息
 *
 * <xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>1348831860</CreateTime>
 *<MsgType><![CDATA[image]]></MsgType>
 *<PicUrl><![CDATA[this is a url]]></PicUrl>
 *<MediaId><![CDATA[media_id]]></MediaId>
 *<MsgId>1234567890123456</MsgId>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class picMsg
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
            "pic_url" => $obj['PicUrl'],
            "media_id" => $obj['MediaId'],
            "msg_id" => $obj['MsgId']
        );
    }
}