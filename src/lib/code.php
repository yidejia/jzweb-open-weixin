<?php
namespace jzweb\open\weixin\lib;


/**
 * 获取授权第一步的code
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/2
 */
class code
{

    private $getCodeUrl = "https://open.weixin.qq.com/connect/qrconnect?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect";

    /**
     * 构造获取code链接
     *
     * @param string $app_id 应用唯一标识
     * @param string $redirect_uri 重定向地址，需要进行UrlEncode
     * @param string $response_type 填code
     * @param string $scope 应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即可
     * @pram string $state 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     *
     * 授权：redirect_uri?code=CODE&state=STATE
     * 不授权：redirect_uri?state=STATE
     *
     * @return string
     */
    public function getCodeUrl($app_id, $redirect_uri, $response_type = "code", $scope = "snsapi_login", $state = "")
    {
        return sprintf($this->getCodeUrl, $app_id, $redirect_uri, $response_type, $scope, $state);
    }


}