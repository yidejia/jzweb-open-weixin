<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\entity\event\clickEvent;
use jzweb\open\weixin\lib\entity\event\locationEvent;
use jzweb\open\weixin\lib\entity\event\scanEvent;
use jzweb\open\weixin\lib\entity\event\subscribeEvent;
use jzweb\open\weixin\lib\entity\event\unsubscribeEvent;
use jzweb\open\weixin\lib\entity\event\viewEvent;
use jzweb\open\weixin\lib\entity\message\linkMsg;
use jzweb\open\weixin\lib\entity\message\locationMsg;
use jzweb\open\weixin\lib\entity\message\picMsg;
use jzweb\open\weixin\lib\entity\message\shortvideoMsg;
use jzweb\open\weixin\lib\entity\message\textMsg;
use jzweb\open\weixin\lib\entity\message\videoMsg;
use jzweb\open\weixin\lib\entity\message\voiceMsg;

/**
 * 微信消息实体对象
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class entityMessage
{


    /**
     * 解析XML并转换为对应的实体对象
     *
     * @param string $xml
     * @return array
     */
    public static function parseXml($xml)
    {
        //处理XML
        $obj = new \SimpleXMLElement ($xml);
        $data = array();
        foreach ($obj as $key => $value) {
            $data[$key] = strval($value);
        }
        //区分消息类型【事件+消息】
        if ($data['MsgType'] == "event" && isset($data['Event'])) {
            switch ($data['Event']) {
                case "subscribe";
                    $result = array('msg_type' => "subscribe", 'type' => 'event', 'data' => subscribeEvent::toArray($data));
                    break;
                case "unsubscribe";
                    $result = array('msg_type' => "unsubscribe", 'type' => 'event', 'data' => unsubscribeEvent::toArray($data));
                    break;
                case "SCAN";
                    $result = array('msg_type' => "scan", 'type' => 'event', 'data' => scanEvent::toArray($data));
                    break;
                case "LOCATION";
                    $result = array('msg_type' => "location", 'type' => 'event', 'data' => locationEvent::toArray($data));
                    break;
                case "CLICK":
                    $result = array('msg_type' => "click", 'type' => 'event', 'data' => clickEvent::toArray($data));
                    break;
                case "VIEW":
                    $result = array('msg_type' => "view", 'type' => 'event', 'data' => viewEvent::toArray($data));
                    break;
                default:
                    $result = array('msg_type' => "unknown", 'type' => 'event', 'data' => $data);
                    break;
            }
        } else {
            switch ($data['MsgType']) {
                case "text";
                    $result = array('msg_type' => "text", 'type' => 'message', 'data' => textMsg::toArray($data));
                    break;
                case "image";
                    $result = array('msg_type' => "image", 'type' => 'message', 'data' => picMsg::toArray($data));
                    break;
                case "voice";
                    $result = array('msg_type' => "voice", 'type' => 'message', 'data' => voiceMsg::toArray($data));
                    break;
                case "video";
                    $result = array('msg_type' => "video", 'type' => 'message', 'data' => videoMsg::toArray($data));
                    break;
                case "shortvideo":
                    $result = array('msg_type' => "shortvideo", 'type' => 'message', 'data' => shortvideoMsg::toArray($data));
                    break;
                case "location":
                    $result = array('msg_type' => "location", 'type' => 'message', 'data' => locationMsg::toArray($data));
                    break;
                case "link":
                    $result = array('msg_type' => "link", 'type' => 'message', 'data' => linkMsg::toArray($data));
                    break;
                default:
                    $result = array('msg_type' => "unknown", 'type' => 'message', 'data' => $data);
                    break;
            }
        }
        return $result;
    }
}
