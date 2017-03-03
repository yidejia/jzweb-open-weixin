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

    /**
     * 通过OpenID获取微信个人用户信息
     *
     * @param string $open_id 普通用户的标识，对当前开发者帐号唯一
     * @param string $access_token 调用凭证
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
}
