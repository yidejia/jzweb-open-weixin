<?php
namespace jzweb\open\weixin\lib\entity\event;

/**
 * 微信公众平台-事件-上报地理位置事件
 *
 *<xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>123456789</CreateTime>
 *<MsgType><![CDATA[event]]></MsgType>
 *<Event><![CDATA[LOCATION]]></Event>
 *<Latitude>23.137466</Latitude>
 *<Longitude>113.352425</Longitude>
 *<Precision>119.385040</Precision>
 *</xml>
 **
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class locationEvent
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
            "latitude" => $obj['Latitude'],
            "longitude" => $obj['Longitude'],
            "precision_val" => $obj['Precision']
        );
    }
}