<?php
namespace jzweb\open\weixin\lib\entity\message;

/**
 * 微信公众平台-消息-地理位置消息
 *
 *<xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>1351776360</CreateTime>
 *<MsgType><![CDATA[location]]></MsgType>
 *<Location_X>23.134521</Location_X>
 *<Location_Y>113.358803</Location_Y>
 *<Scale>20</Scale>
 *<Label><![CDATA[位置信息]]></Label>
 *<MsgId>1*234567890123456</MsgId>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class locationMsg
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
            "location_x" => $obj['Location_X'],
            "location_y" => $obj['Location_Y'],
            "scale" => $obj['Scale'],
            "label" => $obj['Label'],
            "msg_id" => $obj['MsgId']
        );
    }
}