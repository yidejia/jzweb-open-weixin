<?php
namespace jzweb\open\weixin\website;

use jzweb\open\weixin\lib\accessToken;
use jzweb\open\weixin\lib\code;
use jzweb\open\weixin\lib\user;

/**
 * 网站应用-微信用户登录功能
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/2
 */
class wxLogin
{
    private $app_id;
    private $secret;

    public function __construct($app_id, $secret)
    {
        $this->app_id = $app_id;
        $this->secret = $secret;
    }


    /**
     * 第一步： 构造获取code的地址
     *
     * @param string $redirect_uri 重定向地址，需要进行UrlEncode
     * @param string $state 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     *
     * @return string
     */
    public function getCodeUrl($redirect_uri, $state = "")
    {
        return (new code())->getCodeUrl($this->app_id, $redirect_uri, "code", "snsapi_login", $state);
    }

    /**
     * 第二步：获取access_token
     *
     *
     * @param string $code 第一步授权后获取到的code
     *
     * @return array
     */
    public function getAccessToken($code)
    {
        return (new accessToken())->getAccessTokenByCode($this->app_id, $this->secret, $code);
    }


    /**
     * 第三步：获取微信用户信息
     *
     * @param string $open_id 	普通用户标识，对该公众帐号唯一
     * @param string $access_token 第二步获取到的access_token
     * @return array
     */
    public function getUser($open_id,$access_token)
    {
        return (new user())->get($open_id, $access_token);
    }

    /**
     * 获取微信二维码登录信息
     *
     * @param string $redirect_uri 重定向地址，需要进行UrlEncode
     * @param string $id 第三方页面显示二维码的容器id
     * @param string $scope 应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即可
     * @param string $state 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     * @param string $style 提供"black"、"white"可选，默认为黑色文字描述。详见文档底部FAQ
     * @param string $href 自定义样式链接，第三方可根据实际需求覆盖默认样式。详见文档底部FAQ
     *
     * @return array
     */
    public function getQrCode($redirect_uri, $id = "login_container", $scope = "snsapi_login", $state = "", $style = "black", $href = "")
    {

        return array(
            "id" => $id,
            "appid" => $this->app_id,
            "scope" => $scope,
            "redirect_uri" => $redirect_uri,
            "state" => $state,
            "style" => $style,
            "href" => $href
        );
    }

}
