<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;


/**
 * 长链接转短链接接口
 * 主要使用场景： 开发者用于生成二维码的原链接（商品、支付二维码等）太长导致扫码速度和成功率下降，将原长链接通过此接口转成短链接再生成二维码将大大提升扫码速度和成功率。
 *
 * access_token 是  调用接口凭证
 * action 是  此处填long2short，代表长链接转短链接
 * long_url 是  需要转换的长链接，支持http://、https://、weixin://wxpay 格式的url
 *
 * {"errcode":0,"errmsg":"ok","short_url":"http:\/\/w.url.cn\/s\/AvCo6Ih"}
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/11/7
 */
class shorturl
{


    private $url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token=%s";


    /**
     * 长链接转短链接接口
     * 暂时无使用次数限制
     *
     * @param string $access_token 调用接口凭证
     * @param string $long_url 需要转换的长链接，支持http://、https://、weixin://wxpay 格式的url
     * @param string $action 此处填long2short，代表长链接转短链接
     * @return array
     */
    public function createShortUrl($access_token, $long_url, $action = "long2short")
    {

        $requestUrl = sprintf($this->url, $access_token);
        $postData = array(
            "access_token" => $access_token,
            "action_name" => $action,
            "long_url" => $long_url
        );
        $result = (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
        if (isset($result['code'])) {
            return $result;
        } else {
            return $result['short_url'];
        }
    }

}
