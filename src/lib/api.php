<?php
namespace jzweb\open\weixin\lib;


/**
 * api接口相关操作
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/8/7
 */
class api
{

    private $clearQuotaUrl = "https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=%s";

    /**
     * 清除API调用计数器
     *
     * @param string $access_token 调用接口凭据
     * @param string $app_id 公众号的APPID
     *
     * {
     *   "errcode":0,
     *   "errmsg":"ok"
     * }
     *
     * @return mixed
     */
    public function clearQuota($access_token, $app_id)
    {
        $requestUrl = sprintf($this->clearQuotaUrl, $access_token);

        $postData = array(
            "appid" => $app_id,
        );

        return http::post($requestUrl, [], json_encode($postData));
    }
}