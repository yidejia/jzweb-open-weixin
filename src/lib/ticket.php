<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;

/**
 * JSSDK
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/7/24
 */
class ticket
{

    //请求的接口地址
    private $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=%s";


    /**
     * 生成签名之前必须先了解一下jsapi_ticket
     * jsapi_ticket是公众号用于调用微信JS接口的临时票据。
     * 正常情况下，jsapi_ticket的有效期为7200秒，通过access_token来获取。
     * 由于获取jsapi_ticket的api调用次数非常有限，频繁刷新jsapi_ticket会导致api调用受限，影响自身业务，开发者必须在自己的服务全局缓存jsapi_ticket 。
     *
     * @param string $access_token 调用凭证
     * @param string $type 类型
     *
     *
     * {
     *      "errcode":0,
     *      "errmsg":"ok",
     *      "ticket":"bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA",
     *      "expires_in":7200
     * }
     *
     * @return array
     */
    public function get($access_token, $type = "jsapi")
    {
        $requestUrl = sprintf($this->url, $access_token, $type);
        return http::get($requestUrl);
    }


}