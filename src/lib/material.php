<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;


/**
 * 微信永久素材管理
 *
 *  对于常用的素材，开发者可通过本接口上传到微信服务器，永久使用。新增的永久素材也可以在公众平台官网素材管理模块中查询管理。
 *  请注意：
 *  1、最近更新：永久图片素材新增后，将带有URL返回给开发者，开发者可以在腾讯系域名内使用（腾讯系域名外使用，图片将被屏蔽）。
 *  2、公众号的素材库保存总数量有上限：图文消息素材、图片素材上限为5000，其他类型为1000。
 *  3、素材的格式大小等要求与公众平台官网一致：
 *  图片（image）: 2M，支持bmp/png/jpeg/jpg/gif格式
 *  语音（voice）：2M，播放长度不超过60s，mp3/wma/wav/amr格式
 *  视频（video）：10MB，支持MP4格式
 *  缩略图（thumb）：64KB，支持JPG格式
 *  4、图文消息的具体内容中，微信后台将过滤外部的图片链接，图片url需通过"上传图文消息内的图片获取URL"接口上传图片获取。
 *  5、"上传图文消息内的图片获取URL"接口所上传的图片，不占用公众号的素材库中图片数量的5000个的限制，图片仅支持jpg/png格式，大小必须在1MB以下。
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/4/27
 */
class material
{

    private $url_add_news = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s";
    private $url_update_news = "https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=%s";
    private $url_add_news_imgs = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s";
    private $url_add_material = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=%s&type=%s";
    private $url_get = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=%s";
    private $url_batch_get = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=%s";
    private $url_get_total = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=%s";
    private $url_delete = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=%s";


    /**
     * 获取素材列表
     *
     * 在新增了永久素材后，开发者可以分类型获取永久素材的列表。
     * 请注意：
     * 1、获取永久素材的列表，也包含公众号在公众平台官网素材管理模块中新建的图文消息、语音、视频等素材
     * 2、临时素材无法通过本接口获取
     * 3、调用该接口需https协议
     *
     * @param string $access_token 调用接口凭证
     * @param string $type 素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
     * @param int $offset 从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
     * @param int $count 返回素材的数量，取值在1到20之间
     * @return array
     */
    public function batchget($access_token, $type, $offset = 0, $count = 20)
    {
        $requestUrl = sprintf($this->url_batch_get, $access_token);
        return http::post($requestUrl, [], json_encode(["type" => $type, "offset" => $offset, 'count' => $count]));
    }


    /**
     * 获取永久素材
     *
     * @param string $access_token 调用接口凭证
     * @param string $media_id 素材id
     * @return array
     */
    public function get($access_token, $media_id, $type = "", $filename = "")
    {
        $requestUrl = sprintf($this->url_get, $access_token);
        if ($type == "news") {
            return http::post($requestUrl, [], json_encode(["media_id" => $media_id]));
        }elseif($type="video"){
            return http::post($requestUrl, [], json_encode(["media_id" => $media_id]));
        } else {
            return http::downloadAndSave($requestUrl, $filename, json_encode(["media_id" => $media_id]));
        }
    }

    /**
     * 获取素材总数
     *
     * @param string $access_token 调用接口凭证
     * @return array
     */
    public function getTotal($access_token)
    {
        $requestUrl = sprintf($this->url_get_total, $access_token);
        return http::get($requestUrl, []);
    }

    /**
     * 删除永久素材
     *
     * 在新增了永久素材后，开发者可以根据本接口来删除不再需要的永久素材，节省空间。
     * 请注意：
     * 1、请谨慎操作本接口，因为它可以删除公众号在公众平台官网素材管理模块中新建的图文消息、语音、视频等素材（但需要先通过获取素材列表来获知素材的media_id）
     * 2、临时素材无法通过本接口删除
     * 3、调用该接口需https协议
     *
     * @param string $access_token 调用接口凭证
     * @param string $media_id 素材id
     * @return array
     */
    public function delete($access_token, $media_id)
    {
        $requestUrl = sprintf($this->url_delete, $access_token);
        return http::post($requestUrl, [], json_encode(["media_id" => $media_id]));
    }


    /**
     * 开发者可以通过本接口对永久图文素材进行修改。
     * 请注意：
     * 1、也可以在公众平台官网素材管理模块中保存的图文消息（永久图文素材）
     * 2、调用该接口需https协议
     *
     * {
     * "media_id":MEDIA_ID, //要修改的图文消息的id
     * "index":INDEX, //要更新的文章在图文消息中的位置（多图文消息时，此字段才有意义），第一篇为0
     * "articles": {
     * "title": TITLE, //标题
     * "thumb_media_id": THUMB_MEDIA_ID, //图文消息的封面图片素材id（必须是永久mediaID）
     * "author": AUTHOR,//作者
     * "digest": DIGEST,//图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空
     * "show_cover_pic": SHOW_COVER_PIC(0 / 1),//是否显示封面，0为false，即不显示，1为true，即显示
     * "content": CONTENT,//图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS
     * "content_source_url": CONTENT_SOURCE_URL//图文消息的原文地址，即点击“阅读原文”后的URL
     * }
     * }
     *
     * @param string $access_token 调用接口凭证
     * @param array $data
     * @return core\mix
     */
    public function updateNews($access_token, $data)
    {
        $requestUrl = sprintf($this->url_update_news, $access_token);
        return http::post($requestUrl, [], json_encode($data,JSON_UNESCAPED_UNICODE));
    }


    /**
     * 新增永久图文素材
     *
     * {
     *  "title": TITLE, //标题
     *  "thumb_media_id": THUMB_MEDIA_ID,//    图文消息的封面图片素材id（必须是永久mediaID）
     *  "author": AUTHOR,//作者
     *  "digest": DIGEST,//图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空
     *  "show_cover_pic": SHOW_COVER_PIC(0 / 1),//是否显示封面，0为false，即不显示，1为true，即显示
     *  "content": CONTENT,//图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS,涉及图片url必须来源"上传图文消息内的图片获取URL"接口获取。外部图片url将被过滤。
     *  "content_source_url": CONTENT_SOURCE_URL//图文消息的原文地址，即点击“阅读原文”后的URL
     *},
     *
     * @param string $access_token 调用接口凭证
     * @param array $articles
     * @return core\mix
     */
    public function uploadNews($access_token, $articles)
    {
        $requestUrl = sprintf($this->url_add_news, $access_token);
        return http::post($requestUrl, [], json_encode($articles,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 上传图文消息内的图片获取URL
     * 本接口所上传的图片不占用公众号的素材库中图片数量的5000个的限制。图片仅支持jpg/png格式，大小必须在1MB以下。
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     * @return array
     */
    public function uploadNewsImg($access_token, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_news_imgs, $access_token);
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }

    /**
     * 上传永久图片素材
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     * @return array
     */
    public function uploadImage($access_token, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_material, $access_token, "image");
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }

    /**
     * 上传永久语音素材
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     * @return array
     */
    public function uploadVoice($access_token, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_material, $access_token, "voice");
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }

    /**
     * 上传永久缩视频素材
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $title 视频素材的标题不能为空
     * @param string $introduction 视频素材的描述
     * @param string $form_name 上传表单名称
     *
     * @return array
     */
    public function uploadVideo($access_token, $file_path, $title, $introduction = "", $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_material, $access_token, "video");
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r'),
            ],
            [
                'name' => "description",
                'contents' => json_encode(['title' => $title, "introduction" => $introduction],JSON_UNESCAPED_UNICODE)
            ]
        ]);
    }


    /**
     * 上传永久缩略图素材
     *
     * @param string $access_token 调用接口凭证
     * @param string $file_path 上传文件路径注：必须是本地资源
     * @param string $form_name 上传表单名称
     * @return array
     */
    public function uploadThumb($access_token, $file_path, $form_name = "media")
    {
        $requestUrl = sprintf($this->url_add_material, $access_token, "thumb");
        return (new http())->post($requestUrl, [], "", [
            [
                'name' => $form_name,
                'contents' => fopen($file_path, 'r')
            ]
        ]);
    }
}
