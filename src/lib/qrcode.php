<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;


/**
 * 生成带参数的二维码
 * 为了满足用户渠道推广分析和用户帐号绑定等场景的需要，公众平台提供了生成带参数二维码的接口。使用该接口可以获得多个带不同场景值的二维码，用户扫描后，公众号可以接收到事件推送。
 *
 * 目前有2种类型的二维码：
 * 1、临时二维码，是有过期时间的，最长可以设置为在二维码生成后的30天（即2592000秒）后过期，但能够生成较多数量。临时二维码主要用于帐号绑定等不要求二维码永久保存的业务场景
 * 2、永久二维码，是无过期时间的，但数量较少（目前为最多10万个）。永久二维码主要用于适用于帐号绑定、用户来源统计等场景。
 *
 * 用户扫描带场景值二维码时，可能推送以下两种事件：
 * 如果用户还未关注公众号，则用户可以关注公众号，关注后微信会将带场景值关注事件推送给开发者。
 * 如果用户已经关注公众号，在用户扫描后会自动进入会话，微信也会将带场景值扫描事件推送给开发者。
 *
 * 获取带参数的二维码的过程包括两步，首先创建二维码ticket，然后凭借ticket到指定URL换取二维码。
 *
 * ticket:获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
 * expire_seconds:该二维码有效时间，以秒为单位。 最大不超过2592000（即30天）。
 * url:二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片
 * {"ticket":"gQH47joAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2taZ2Z3TVRtNzJXV1Brb3ZhYmJJAAIEZ23sUwMEmm3sUw==","expire_seconds":60,"url":"http:\/\/weixin.qq.com\/q\/kZgfwMTm72WWPkovabbI"}
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/5/11
 */
class qrcode
{


    private $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s";

    /**
     * 创建临时二维码
     * 30天时效限制，无数量限制
     *
     * @param string $access_token 调用接口凭证
     * @param int|string $scene_id
     * @param int $expire_time
     * @return array
     */
    public function createQrScane($access_token, $scene_id, $expire_time = 2592000)
    {
        $requestUrl = sprintf($this->url, $access_token);
        if(is_numeric($scene_id)) {
            $postData = array(
                "expire_seconds" => $expire_time,
                "action_name" => "QR_SCENE",
                "action_info" => array("scene" => array("scene_id" => $scene_id))
            );
        }else{
            $postData = array(
                "expire_seconds" => $expire_time,
                "action_name" => "QR_STR_SCENE",
                "action_info" => array("scene" => array("scene_str" => $scene_id))
            );
        }
        $result = (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
        if (isset($result['code'])) {
            return $result;
        } else {
            return array_merge($result, array('qrcode_url' => "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode($result['ticket'])));
        }
    }

    /**
     * 创建永久二维码
     * 100000个限制，永久储存
     *
     * @param string $access_token 调用接口凭证
     * @param int $scene_id
     * @return array
     */
    public function createQrLimitScane($access_token, $scene_id)
    {

        $requestUrl = sprintf($this->url, $access_token);
        $postData = array(
            "action_name" => "QR_LIMIT_STR_SCENE",
            "action_info" => array("scene" => array("scene_str" => $scene_id))
        );
        $result = (new http())->post($requestUrl, [], json_encode($postData, JSON_UNESCAPED_UNICODE));
        if (isset($result['code'])) {
            return $result;
        } else {
            return array_merge($result, array('qrcode_url' => "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode($result['ticket'])));
        }
    }

}
