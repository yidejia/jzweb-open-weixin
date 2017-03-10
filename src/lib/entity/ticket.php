<?php
namespace jzweb\open\weixin\lib\entity;

/**
 * 微信开放平台-推送component_verify_ticket协议-实体对象
 *
 * <xml>
 * <AppId> </AppId>
 * <CreateTime>1413192605 </CreateTime>
 * <InfoType> </InfoType>
 * <ComponentVerifyTicket> </ComponentVerifyTicket>
 * </xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class ticket
{
    private $data = array();

    /**
     * ticket constructor.
     * @param $xml_content 接收到的XML格式内容的数据
     */
    public function __construct($xml_content)
    {
        //处理XML
        $obj = new \SimpleXMLElement ($xml_content);
        foreach ($obj as $key => $value) {
            $this->data[$key] = strval($value);
        }
    }

    /**
     * 转换为数组
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            "app_id" => $this->data['AppId'],
            "create_time" => $this->data['CreateTime'],
            "info_type" => $this->data['InfoType'],
            "component_verify_ticket" => $this->data['ComponentVerifyTicket']
        );
    }
}