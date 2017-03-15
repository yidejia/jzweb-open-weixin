<?php
namespace jzweb\open\weixin\lib\entity\message;

/**
 * 微信公众平台-消息-语音消息
 * 请注意，开通语音识别后，用户每次发送语音给公众号时，微信会在推送的语音消息XML数据包中，增加一个Recongnition字段（注：由于客户端缓存，开发者开启或者关闭语音识别功能，对新关注者立刻生效，对已关注用户需要24小时生效。开发者可以重新关注此帐号进行测试）。开启语音识别后的语音XML数据包如下：
 *
 * <xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>1357290913</CreateTime>
 *<MsgType><![CDATA[voice]]></MsgType>
 *<MediaId><![CDATA[media_id]]></MediaId>
 *<Format><![CDATA[Format]]></Format>
 *<MsgId>1234567890123456</MsgId>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class voiceMsg
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
            "format" => $obj['Format'],
            "recognition" => $obj['Recognition'],
            "msg_id" => $obj['MsgId']
        );
    }
}