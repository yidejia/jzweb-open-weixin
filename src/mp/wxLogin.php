<?php
namespace jzweb\open\weixin\mp;

use jzweb\open\weixin\lib\accessToken;
use jzweb\open\weixin\lib\api;
use jzweb\open\weixin\lib\code;
use jzweb\open\weixin\lib\custom;
use jzweb\open\weixin\lib\user;

/**
 * 公众平台-微信用户登录功能
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
        return (new code())->getCode2Url($this->app_id, $redirect_uri, "code", "snsapi_userinfo", $state);
    }

    /**
     * 第一步： 构造获取code的地址
     * 开放平台代公众号实现
     *
     * @param string $redirect_uri 重定向地址，需要进行UrlEncode
     * @param string $component_appid 服务开发商的appid
     * @param string $state 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     *
     * @return string
     */
    public function getCodeUrl2($redirect_uri, $component_appid, $state = "")
    {
        return (new code())->getCode3Url($this->app_id, $redirect_uri, $component_appid, "code", "snsapi_userinfo", $state);
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
     * 第二步：获取access_token
     * 开放平台代公众号实现
     *
     *
     * @param string $code 第一步授权后获取到的code
     * @param string $component_appid 服务开发商的appid
     * @param string $component_access_token 服务开发方的access_token
     *
     * @return array
     */
    public function getAccessToken2($code, $component_appid, $component_access_token)
    {
        return (new accessToken())->getAccessTokenByCode2($this->app_id, $code, $component_appid, $component_access_token);
    }


    /**
     * 第三步：获取微信用户信息
     *
     * @param string $open_id 普通用户标识，对该公众帐号唯一
     * @param string $access_token 第二步获取到的access_token
     * @return array
     */
    public function getUser($open_id, $access_token)
    {
        return (new user())->get($open_id, $access_token);
    }

    /**
     * 获取微信用户信息
     *
     * @param string $open_id 普通用户标识，对该公众帐号唯一
     * @param string $access_token 第二步获取到的access_token
     * @return array
     */
    public function getUser1($open_id, $access_token)
    {
        return (new user())->get1($open_id, $access_token);
    }

    /**
     * 批量获取用户基本信息
     *
     * @param string $access_token 公众号接口调用凭证
     * @param array $openid_arr 包含openid的一纬数组
     *
     * @return array
     */
    public function batchGetUserList($access_token, $openid_arr)
    {

        return (new user())->batchget($access_token, $openid_arr);
    }

    /**
     * 获取微信用户列表
     *
     * @param string $access_token 公众号接口调用凭证
     * @param string $next_open_id 第一个拉取的OPENID，不填默认从头开始拉取
     *
     * @return array
     */
    public function getUserList($access_token, $next_open_id)
    {

        return (new user())->getList($access_token, $next_open_id);
    }


    /**
     * 微信公众号客户发送接口
     *
     * @param string $access_token 公众号接口调用凭证
     * @param string $type 发送的消息类型
     * @param string $openid 发送的微信用户openid
     * @param string|array $data 发送的内容
     *
     * @return array
     */
    public function customSend($access_token, $type, $openid, $data)
    {

        return (new custom())->send($type, $access_token, $openid, $data);
    }


    /**
     * 数据清零,每个公众号每月有10次清零机会
     * 公众号调用或第三方平台帮公众号调用对公众号的所有api调用（包括第三方帮其调用）次数进行清零
     *
     * @param $access_token
     * @return mixed
     */
    public function clearQuota($access_token)
    {

        return (new api())->clearQuota($access_token, $this->app_id);
    }
}
