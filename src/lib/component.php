<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;


/**
 * 微信第三方平台API
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/10
 */
class component
{

    private $getComponentAccessTokenUrl = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
    private $getPreAuthCodeUrl = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=%s";
    private $getComponentLoginPageUrl = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=%s&pre_auth_code=%s&redirect_uri=%s";
    private $getApiQueryAuthUrl = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=%s";
    private $getApiAuthorizerTokenUrl = "https:// api.weixin.qq.com /cgi-bin/component/api_authorizer_token?component_access_token=%s";
    private $getApiGetAuthorizerInfoUrl = "https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token=%s";
    private $getApiGetAuthorizerOptionUrl = "https://api.weixin.qq.com/cgi-bin/component/ api_get_authorizer_option?component_access_token=%s";
    private $getApiSetAuthorizerOptionUrl = "https://api.weixin.qq.com/cgi-bin/component/ api_set_authorizer_option?component_access_token=%s";

    /**
     * 获取第三方平台component_access_token
     *
     * @param string $component_appid 第三方平台appid
     * @param string $component_appsecret 第三方平台appsecret
     * @param string $component_verify_ticket 微信后台推送的ticket，此ticket会定时推送，具体请见本页的推送说明
     *
     *{
     *  "component_access_token":"61W3mEpU66027wgNZ_MhGHNQDHnFATkDa9-2llqrMBjUwxRSNPbVsMmyD-yq8wZETSoE5NQgecigDrSHkPtIYA",
     *  "expires_in":7200
     *}
     * @return array
     */
    public function getComponentAccessToken($component_appid, $component_appsecret, $component_verify_ticket)
    {
        $postData = array(
            "component_appid" => $component_appid,
            "component_appsecret" => $component_appsecret,
            "component_verify_ticket" => $component_verify_ticket
        );
        return http::post($this->getComponentAccessTokenUrl, json_encode($postData));
    }

    /**
     * 获取预授权码pre_auth_code
     *
     * @param string $component_appid 第三方平台方appid
     * @param string $component_access_token 第三方平台access_token
     *
     *{
     *  "pre_auth_code":"Cx_Dk6qiBE0Dmx4EmlT3oRfArPvwSQ-oa3NL_fwHM7VI08r52wazoZX2Rhpz1dEw",
     *  "expires_in":600
     *}
     * @return array
     */
    public function getPreAuthCode($component_appid, $component_access_token)
    {
        $url = sprintf($this->getPreAuthCodeUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid
        );
        return http::post($url, json_encode($postData));
    }

    /**
     * 引入用户进入授权页
     *
     * @param string $component_appid 第三方平台方appid
     * @param string $pre_auth_code 预授权码
     * @param string $redirect_uri 回调URI
     *
     * @return string
     */
    public function getComponentLoginPage($component_appid, $pre_auth_code, $redirect_uri)
    {
        return sprintf($this->getComponentLoginPageUrl, $component_appid, $pre_auth_code, $redirect_uri);
    }


    /**
     * 使用授权码换取公众号的接口调用凭据和授权信息
     *
     * @param string $component_appid 第三方平台appid
     * @param string $authorization_code 授权code,会在授权成功时返回给第三方平台，详见第三方平台授权流程说明
     * @param string $component_access_token 第三方平台access_token
     *
     * {
     *  "authorization_info": {
     *  "authorizer_appid": "wxf8b4f85f3a794e77",
     *  "authorizer_access_token": "QXjUqNqfYVH0yBE1iI_7vuN_9gQbpjfK7hYwJ3P7xOa88a89-Aga5x1NMYJyB8G2yKt1KCl0nPC3W9GJzw0Zzq_dBxc8pxIGUNi_bFes0qM",
     *  "expires_in": 7200,
     *  "authorizer_refresh_token": "dTo-YCXPL4llX-u1W1pPpnp8Hgm4wpJtlR6iV0doKdY",
     *  "func_info": [
     *      {
     *          "funcscope_category": {
     *          "id": 1
     *      }
     *  },
     *          {
     *          "funcscope_category": {
     *          "id": 2
     *          }
     *  },
     *      {
     *          "funcscope_category": {
     *          "id": 3
     *      }
     *      }
     *      ]
     *}
     *
     * @return array
     */
    public function getApiQueryAuth($component_appid, $authorization_code, $component_access_token)
    {
        $url = sprintf($this->getApiQueryAuthUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid,
            "authorization_code" => $authorization_code
        );
        return http::post($url, json_encode($postData));
    }


    /**
     * 获取（刷新）授权公众号的接口调用凭据（令牌）
     *
     * @param string $component_appid 第三方平台appid
     * @param string $authorizer_appid 授权方appid
     * @param string $authorizer_refresh_token 授权方的刷新令牌，刷新令牌主要用于公众号第三方平台获取和刷新已授权用户的access_token，只会在授权时刻提供，请妥善保存。一旦丢失，只能让用户重新授权，才能再次拿到新的刷新令牌
     * @param string $component_access_token 第三方平台access_token
     *
     * {
     *       "authorizer_access_token": "aaUl5s6kAByLwgV0BhXNuIFFUqfrR8vTATsoSHukcIGqJgrc4KmMJ-JlKoC_-NKCLBvuU1cWPv4vDcLN8Z0pn5I45mpATruU0b51hzeT1f8",
     *       "expires_in": 7200,
     *       "authorizer_refresh_token": "BstnRqgTJBXb9N2aJq6L5hzfJwP406tpfahQeLNxX0w"
     *  }
     * @return array
     */
    public function getApiAuthorizerToken($component_appid, $authorizer_appid, $authorizer_refresh_token, $component_access_token)
    {
        $url = sprintf($this->getApiAuthorizerTokenUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid,
            "authorizer_appid" => $authorizer_appid,
            "authorizer_refresh_token" => $authorizer_refresh_token
        );
        return http::post($url, json_encode($postData));
    }


    /**
     * 获取授权方的公众号帐号基本信息
     *
     * @param string $component_appid 服务appid
     * @param string $authorizer_appid 授权方appid
     * @param string $component_access_token 第三方平台access_token
     *
     *
     * {
     *      "authorizer_info": {
     *      "nick_name": "微信SDK Demo Special",
     *      "head_img": "http://wx.qlogo.cn/mmopen/GPy",
     *      "service_type_info": { "id": 2 },
     *      "verify_type_info": { "id": 0 },
     *      "user_name":"gh_eb5e3a772040",
     *      "principal_name":"腾讯计算机系统有限公司",
     *      "business_info": {"open_store": 0, "open_scan": 0, "open_pay": 0, "open_card": 0, "open_shake": 0},
     *      "alias":"paytest01"
     *      "qrcode_url":"URL",
     *      },
     *      "authorization_info": {
     *      "appid": "wxf8b4f85f3a794e77",
     *      "func_info": [
     *      { "funcscope_category": { "id": 1 } },
     *      { "funcscope_category": { "id": 2 } },
     *      { "funcscope_category": { "id": 3 } }
     *      ]
     *      }
     * }
     * @return array
     */
    public function getApiGetAuthorizerInfo($component_appid, $authorizer_appid, $component_access_token)
    {
        $url = sprintf($this->getApiGetAuthorizerInfoUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid,
            "authorizer_appid" => $authorizer_appid,
        );
        return http::post($url, json_encode($postData));
    }

    /**
     * 获取授权方的选项设置信息
     *
     * @param string $component_appid 第三方平台appid
     * @param string $authorizer_appid 授权公众号appid
     * @param string $option_name 选项名称
     * @param string $component_access_token 第三方平台access_token
     *
     *
     * {
     *  "authorizer_appid":"wx7bc5ba58cabd00f4",
     *  "option_name":"voice_recognize",
     *  "option_value":"1"
     * }
     *
     * @return array
     */
    public function getApiGetAuthorizerOption($component_appid, $authorizer_appid, $option_name, $component_access_token)
    {
        $url = sprintf($this->getApiGetAuthorizerOptionUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid,
            "authorizer_appid" => $authorizer_appid,
            "option_name" => $option_name
        );
        return http::post($url, json_encode($postData));
    }


    /**
     * 设置授权方的选项信息
     *
     * @param string $component_appid 第三方平台appid
     * @param string $authorizer_appid 授权公众号appid
     * @param string $option_name 选项名称
     * @param string $option_name 设置的选项值
     * @param string $component_access_token 第三方平台access_token
     *
     *{
     *  "errcode":0,
     *  "errmsg":"ok"
     *}
     *
     * @return array
     */
    public function getApiSetAuthorizerOption($component_appid, $authorizer_appid, $option_name, $option_value, $component_access_token)
    {
        $url = sprintf($this->getApiSetAuthorizerOptionUrl, $component_access_token);
        $postData = array(
            "component_appid" => $component_appid,
            "authorizer_appid" => $authorizer_appid,
            "option_name" => $option_name,
            "option_value" => $option_value
        );
        return http::post($url, json_encode($postData));
    }
}
