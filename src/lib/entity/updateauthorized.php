<?php
namespace jzweb\open\weixin\lib\entity;

/**
 * 微信开放平台-授权更新通知-实体对象
 *
 *<xml>
 *<AppId>第三方平台appid</AppId>
 *<CreateTime>1413192760</CreateTime>
 *<InfoType>authorized</InfoType>
 *<AuthorizerAppid>公众号appid</AuthorizerAppid>
 *<AuthorizationCode>授权码（code）</AuthorizationCode>
 *<AuthorizationCodeExpiredTime>过期时间</AuthorizationCodeExpiredTime>
 *</xml>
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class updateauthorized
{
    /**
     * 转换为数组
     *
     * @param array $obj 要转换的对象数组
     * @return array
     */
    public function toArray($obj)
    {
        return array(
            'the_time' => date("Y-m-d H:i:s"),
            "app_id" => $obj['AppId'],
            "create_time" => $obj['CreateTime'],
            "info_type" => $obj['InfoType'],
            "authorizer_appid" => $obj['AuthorizerAppid'],
            "authorizer_code" => $obj['AuthorizationCode'],
            "authorizer_code_expired_time" => $obj['AuthorizationCodeExpiredTime']
        );
    }
}