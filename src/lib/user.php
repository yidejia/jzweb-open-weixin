<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;

/**
 * 获取微信用户信息
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/2
 */
class user
{

    //请求的接口地址
    private $url = "https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s";
    private $url1 = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN";
    private $getUserListUrl = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s&next_openid=%s";
    private $getBatchGetUrl = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=%s";

    /**
     * 通过OpenID获取微信个人用户信息
     *
     * @param string $open_id 普通用户的标识，对当前开发者帐号唯一
     * @param string $access_token 调用凭证
     * 开放平台网站应用
     *
     *
     *  {
     *      "openid":"OPENID",
     *      "nickname":"NICKNAME",
     *      "sex":1,
     *      "province":"PROVINCE",
     *      "city":"CITY",
     *      "country":"COUNTRY",
     *      "headimgurl": "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0",
     *      "privilege":[
     *              "PRIVILEGE1",
     *              "PRIVILEGE2"
     *      ],
     *      "unionid": " o6_bmasdasdsad6_2sgVt7hMZOPfL"
     *
     *  }
     *
     * @return array
     */
    public function get($open_id, $access_token)
    {
        $requestUrl = sprintf($this->url, $access_token, $open_id);
        return http::get($requestUrl);
    }

    /**
     * 通过OpenID获取微信个人用户信息
     * 开放平台第三方公众号平台
     *
     * {
     *"subscribe": 1,
     *"openid": "o6_bmjrPTlm6_2sgVt7hMZOPfL2M",
     *"nickname": "Band",
     *"sex": 1,
     *"language": "zh_CN",
     *"city": "广州",
     *"province": "广东",
     *"country": "中国",
     *"headimgurl":  "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4
     *eMsv84eavHiaiceqxibJxCfHe/0",
     *"subscribe_time": 1382694957,
     *"unionid": " o6_bmasdasdsad6_2sgVt7hMZOPfL"
     *"remark": "",
     *"groupid": 0,
     *"tagid_list":[128,2]
     * }
     * @param string $open_id 普通用户的标识，对当前开发者帐号唯一
     * @param string $access_token 调用接口凭证
     * @return array
     */
    public function get1($open_id, $access_token)
    {
        $requestUrl = sprintf($this->url1, $access_token, $open_id);
        return http::get($requestUrl);
    }

    /**
     * 获取用户列表
     * 公众号可通过本接口来获取帐号的关注者列表，关注者列表由一串OpenID（加密后的微信号，每个用户对每个公众号的OpenID是唯一的）组成。一次拉取调用最多拉取10000个关注者的OpenID，可以通过多次拉取的方式来满足需求。
     *
     * {
     *"total":23000,
     *"count":10000,
     *"data":{"
     *openid":[
     *"OPENID1",
     *"OPENID2",
     *...,
     *"OPENID10000"
     *]
     *},
     *"next_openid":"OPENID10000"
     *}
     *
     * @param $access_token 调用接口凭证
     * @param string $next_openid 第一个拉取的OPENID，不填默认从头开始拉取
     *
     * @return array
     */
    public function getList($access_token, $next_openid = "")
    {
        $requestUrl = sprintf($this->getUserListUrl, $access_token, $next_openid);
        return http::get($requestUrl);
    }


    /**
     * 批量获取用户基本信息
     * 开发者可通过该接口来批量获取用户基本信息。最多支持一次拉取100条。
     *
     * {
     *"user_list": [
     *{
     *"openid": "otvxTs4dckWG7imySrJd6jSi0CWE",
     *"lang": "zh-CN"
     *},
     *{
     *"openid": "otvxTs_JZ6SEiP0imdhpi50fuSZg",
     *"lang": "zh-CN"
     *}
     *]
     *}*
     *
     * @param $access_token 调用接口凭证
     * @param string $openid_arr 包含openid的一纬数组
     *
     * @return array
     */
    public function batchget($access_token, $openid_arr)
    {
        $requestUrl = sprintf($this->getBatchGetUrl, $access_token);
        $openid_list = array();
        //转换格式
        foreach ($openid_arr as $openid) {
            $openid_list[] = array("openid" => $openid, "lang" => "zh-CN");
        }
        $postData = array("user_list" => $openid_list);
        return http::post($requestUrl, [], json_encode($postData));
    }


}
