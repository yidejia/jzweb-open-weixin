<?php
namespace jzweb\open\weixin\lib;


use jzweb\open\weixin\lib\core\http;

/**
 * 微信素材相关接口
 * 注意点：
 * 1、临时素材media_id是可复用的。
 * 2、媒体文件在微信后台保存时间为3天，即3天后media_id失效。
 * 3、上传临时素材的格式、大小限制与公众平台官网一致。
 * 图片（image）: 2M，支持PNG\JPEG\JPG\GIF格式
 * 语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
 * 视频（video）：10MB，支持MP4格式
 * 缩略图（thumb）：64KB，支持JPG格式
 * 4、需使用https调用本接口。
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/30
 */
class media
{

    private $getUrl = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s";
    private $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s";


    /**
     * 获取素材详情
     *
     * @param string $access_token 调用接口凭证
     * @param string $media_id 素材id
     * @return array
     */
    public function get($access_token, $media_id, $type = "", $filename = "")
    {
        if ($type == "voice" || $type == "video") {
            $requestUrl = sprintf($this->getUrl, $access_token, $media_id);
            return http::downloadAndSave($requestUrl, $filename);
        } else {
            $requestUrl = sprintf($this->getUrl, $access_token, $media_id);
            return http::get($requestUrl);
        }
    }

    /**
     * 新增临时素材
     *
     * 公众号经常有需要用到一些临时性的多媒体素材的场景，例如在使用接口特别是发送消息时，对多媒体文件、多媒体消息的获取和调用等操作，是通过media_id来进行的。素材管理接口对所有认证的订阅号和服务号开放。通过本接口，公众号可以新增临时素材（即上传临时多媒体文件）。
     *
     * @param string $access_token 调用接口凭证
     * @param string $type 媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     *
     * @return array
     */
    public function upload($access_token, $type, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url, $access_token, $type);
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }

}