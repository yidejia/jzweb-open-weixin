<?php
namespace jzweb\open\weixin\lib\entity\message;

/**
 * 微信公众平台-消息-链接消息
 *
 *<xml>
 *<ToUserName><![CDATA[toUser]]></ToUserName>
 *<FromUserName><![CDATA[fromUser]]></FromUserName>
 *<CreateTime>1351776360</CreateTime>
 *<MsgType><![CDATA[link]]></MsgType>
 *<Title><![CDATA[公众平台官网链接]]></Title>
 *<Description><![CDATA[公众平台官网链接]]></Description>
 *<Url><![CDATA[url]]></Url>
 *<MsgId>1234567890123456</MsgId>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/15
 */

class linkMsg
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
            "title" => $obj['Title'],
            "description" => $obj['Description'],
            "url" => $obj['Url'],
            "msg_id" => $obj['MsgId']
        );
    }
}