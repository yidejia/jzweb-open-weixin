<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\entity\event\clickEvent;
use jzweb\open\weixin\lib\entity\event\locationEvent;
use jzweb\open\weixin\lib\entity\event\scanEvent;
use jzweb\open\weixin\lib\entity\event\subscribeEvent;
use jzweb\open\weixin\lib\entity\event\unsubscribeEvent;
use jzweb\open\weixin\lib\entity\event\viewEvent;


/**
 * 微信事件实体对象
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class entityEvent
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

        switch ($data['Event']) {
            case "subscribe";
                $result = array('msg_type' => "subscribe", 'data' => subscribeEvent::toArray($data));
                break;
            case "unsubscribe";
                $result = array('msg_type' => "unsubscribe", 'data' => unsubscribeEvent::toArray($data));
                break;
            case "SCAN";
                $result = array('msg_type' => "SCAN", 'data' => scanEvent::toArray($data));
                break;
            case "LOCATION";
                $result = array('msg_type' => "LOCATION", 'data' => locationEvent::toArray($data));
                break;
            case "CLICK":
                $result = array('msg_type' => "CLICK", 'data' => clickEvent::toArray($data));
                break;
            case "VIEW":
                $result = array('msg_type' => "VIEW", 'data' => viewEvent::toArray($data));
                break;
            default:
                $result = array('msg_type' => "unknown", 'data' => $data);
                break;
        }
        return $result;
    }
}
