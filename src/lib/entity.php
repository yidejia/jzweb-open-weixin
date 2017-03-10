<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\entity\authorized;
use jzweb\open\weixin\lib\entity\ticket;
use jzweb\open\weixin\lib\entity\unauthorized;
use jzweb\open\weixin\lib\entity\updateauthorized;

/**
 * 微信的实体对象
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class entity
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
        switch ($data['InfoType']) {
            case "unauthorized";
                $result = array('msgType' => "unauthorized", 'data' => unauthorized::toArray($data));
                break;
            case "authorized";
                $result = array('msgType' => "authorized", 'data' => authorized::toArray($data));
                break;
            case "updateauthorized";
                $result = array('msgType' => "updateauthorized", 'data' => updateauthorized::toArray($data));
                break;
            case "component_verify_ticket";
                $result = array('msgType' => "component_verify_ticket", 'data' => ticket::toArray($data));
                break;
            default:
                $result = array('msgType' => "unknown", 'data' => $data);
                break;
        }
        return $result;
    }
}
