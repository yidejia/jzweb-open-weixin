<?php
namespace jzweb\open\weixin\lib\entity\auth;

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
class ticketAuth
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
            "app_id" => $obj['AppId'],
            "create_time" => $obj['CreateTime'],
            "info_type" => $obj['InfoType'],
            "component_verify_ticket" => $obj['ComponentVerifyTicket']
        );
    }
}