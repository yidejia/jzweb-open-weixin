<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\entity\auth\authorizedAuth;
use jzweb\open\weixin\lib\entity\auth\ticketAuth;
use jzweb\open\weixin\lib\entity\auth\unauthorizedAuth;
use jzweb\open\weixin\lib\entity\auth\updateauthorizedAuth;

/**
 * 微信授权实体对象
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class entityAuth
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
                $result = array('msg_type' => "unauthorized", 'data' => unauthorizedAuth::toArray($data));
                break;
            case "authorized";
                $result = array('msg_type' => "authorized", 'data' => authorizedAuth::toArray($data));
                break;
            case "updateauthorized";
                $result = array('msg_type' => "updateauthorized", 'data' => updateauthorizedAuth::toArray($data));
                break;
            case "component_verify_ticket";
                $result = array('msg_type' => "component_verify_ticket", 'data' => ticketAuth::toArray($data));
                break;
            default:
                $result = array('msg_type' => "unknown", 'data' => $data);
                break;
        }
        return $result;
    }
}
