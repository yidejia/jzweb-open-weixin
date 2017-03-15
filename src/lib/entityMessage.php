<?php
namespace jzweb\open\weixin\lib;

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

        switch ($data['MsgType']) {
            case "text";
                $result = array('msg_type' => "text", 'data' => textMsg::toArray($data));
                break;
            case "image";
                $result = array('msg_type' => "image", 'data' => picMsg::toArray($data));
                break;
            case "voice";
                $result = array('msg_type' => "voice", 'data' => voiceMsg::toArray($data));
                break;
            case "video";
                $result = array('msg_type' => "video", 'data' => videoMsg::toArray($data));
                break;
            case "shortvideo":
                $result = array('msg_type' => "shortvideo", 'data' => shortvideoMsg::toArray($data));
                break;
            case "location":
                $result = array('msg_type' => "location", 'data' => locationMsg::toArray($data));
                break;
            case "link":
                $result = array('msg_type' => "link", 'data' => linkMsg::toArray($data));
                break;
            default:
                $result = array('msg_type' => "unknown", 'data' => $data);
                break;
        }
        return $result;
    }
}
