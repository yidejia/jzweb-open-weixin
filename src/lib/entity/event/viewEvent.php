<?php
namespace jzweb\open\weixin\lib\entity\event;

/**
 * 微信公众平台-事件-点击菜单跳转链接时的事件推送
 *
 *<xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[FromUser]]></FromUserName>
 *<CreateTime>123456789</CreateTime>
 *<MsgType><![CDATA[event]]></MsgType>
 *<Event><![CDATA[VIEW]]></Event>
 *<EventKey><![CDATA[www.qq.com]]></EventKey>
 *</xml>*
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class viewEvent
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
            "event" => $obj['Event'],
            "event_key" => $obj['EventKey']
        );
    }
}