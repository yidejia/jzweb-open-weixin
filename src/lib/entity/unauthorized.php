<?php
namespace jzweb\open\weixin\lib\entity;

/**
 * 微信开放平台-取消授权通知-实体对象
 *
 *<xml>
 *<AppId>第三方平台appid</AppId>
 *<CreateTime>1413192760</CreateTime>
 *<InfoType>unauthorized</InfoType>
 *<AuthorizerAppid>公众号appid</AuthorizerAppid>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class unauthorized
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
            "authorizer_appid" => $this->data['AuthorizerAppid']
        );
    }
}