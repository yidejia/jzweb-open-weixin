<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;

/**
 * 获取微信用户信息
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/2
 */
class accessToken
{

    private $getAccessTokenUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=%s";
    private $refreshAccessTokenUrl = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=%s&grant_type=%s&refresh_token=%s";

    /**
     * 通过code获取access_token接口
     *
     * @param string $app_id 应用唯一标识，在微信开放平台提交应用审核通过后获得
     * @param string $secret 应用密钥AppSecret，在微信开放平台提交应用审核通过后获得
     * @param string $code 填写第一步获取的code参数
     * @param string $grant_type 填authorization_code
     *
     * {
     *      "access_token":"ACCESS_TOKEN",
     *      "expires_in":7200,
     *      "refresh_token":"REFRESH_TOKEN",
     *      "openid":"OPENID",
     *      "scope":"SCOPE"
     * }
     *
     * @return array
     */
    public function getAccessTokenByCode($app_id, $secret, $code, $grant_type = "authorization_code")
    {
        $requestUrl = sprintf($this->getAccessTokenUrl, $app_id, $secret, $code, $grant_type);
        return http::get($requestUrl);
    }


    /**
     * 通过refresh_token刷新access_token
     *
     * @param string $app_id 应用唯一标识
     * @param string $refresh_token 填写通过access_token获取到的refresh_token参数
     * @param string $grant_type 填refresh_token
     *
     * {
     *      "access_token":"ACCESS_TOKEN",
     *      "expires_in":7200,
     *      "refresh_token":"REFRESH_TOKEN",
     *      "openid":"OPENID",
     *      "scope":"SCOPE"
     * }
     *
     * @return array
     */
    public function refreshAccessToken($app_id, $refresh_token, $grant_type = "refresh_token")
    {
        $requestUrl = sprintf($this->refreshAccessTokenUrl, $app_id, $refresh_token, $grant_type);
        return http::get($requestUrl);
    }


}