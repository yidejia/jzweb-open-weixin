<?php
namespace jzweb\open\weixin\lib\core;

/**
 * 封装错误异常处理
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/3
 */

class exception
{
    //微信开放平台错误码列表
    private static $codeList = array(
        40001 => array('msg' => 'invalid credential', 'desc' => '不合法的调用凭证'),
        40002 => array('msg' => 'invalid grant_type', 'desc' => '不合法的grant_type'),
        40003 => array('msg' => 'invalid openid', 'desc' => '不合法的OpenID'),
        40004 => array('msg' => 'invalid media type', 'desc' => '不合法的媒体文件类型'),
        40007 => array('msg' => 'invalid media_id', 'desc' => '不合法的media_id'),
        40008 => array('msg' => 'invalid message type', 'desc' => '不合法的message_type'),
        40009 => array('msg' => 'invalid image size', 'desc' => '不合法的图片大小'),
        40010 => array('msg' => 'invalid voice size', 'desc' => '不合法的语音大小'),
        40011 => array('msg' => 'invalid video size', 'desc' => '不合法的视频大小'),
        40012 => array('msg' => 'invalid thumb size', 'desc' => '不合法的缩略图大小'),
        40013 => array('msg' => 'invalid appid', 'desc' => '不合法的AppID'),
        40014 => array('msg' => 'invalid access_token', 'desc' => '不合法的access_token'),
        40015 => array('msg' => 'invalid menu type', 'desc' => '不合法的菜单类型'),
        40016 => array('msg' => 'invalid button size', 'desc' => '不合法的菜单按钮个数'),
        40017 => array('msg' => 'invalid button type', 'desc' => '不合法的按钮类型'),
        40018 => array('msg' => 'invalid button name size', 'desc' => '不合法的按钮名称长度'),
        40019 => array('msg' => 'invalid button key size', 'desc' => '不合法的按钮KEY长度'),
        40020 => array('msg' => 'invalid button url size', 'desc' => '不合法的url长度'),
        40023 => array('msg' => 'invalid sub button size', 'desc' => '不合法的子菜单按钮个数'),
        40024 => array('msg' => 'invalid sub button type', 'desc' => '不合法的子菜单类型'),
        40025 => array('msg' => 'invalid sub button name size', 'desc' => '不合法的子菜单按钮名称长度'),
        40026 => array('msg' => 'invalid sub button key size', 'desc' => '不合法的子菜单按钮KEY长度'),
        40027 => array('msg' => 'invalid sub button url size', 'desc' => '不合法的子菜单按钮url长度'),
        40029 => array('msg' => 'invalid code', 'desc' => '不合法或已过期的code'),
        40030 => array('msg' => 'invalid refresh_token', 'desc' => '不合法的refresh_token'),
        40036 => array('msg' => 'invalid template_id size', 'desc' => '不合法的template_id长度'),
        40037 => array('msg' => 'invalid template_id', 'desc' => '不合法的template_id'),
        40039 => array('msg' => 'invalid url size', 'desc' => '不合法的url长度'),
        40048 => array('msg' => 'invalid url domain', 'desc' => '不合法的url域名'),
        40054 => array('msg' => 'invalid sub button url domain', 'desc' => '不合法的子菜单按钮url域名'),
        40055 => array('msg' => 'invalid button url domain', 'desc' => '不合法的菜单按钮url域名'),
        40066 => array('msg' => 'invalid url', 'desc' => '不合法的url'),
        41001 => array('msg' => 'access_token missing', 'desc' => '缺失access_token参数'),
        41002 => array('msg' => 'appid missing', 'desc' => '缺失appid参数'),
        41003 => array('msg' => 'refresh_token missing', 'desc' => '缺失refresh_token参数'),
        41004 => array('msg' => 'appsecret missing', 'desc' => '缺失secret参数'),
        41005 => array('msg' => 'media data missing', 'desc' => '缺失二进制媒体文件'),
        41006 => array('msg' => 'media_id missing', 'desc' => '缺失media_id参数'),
        41007 => array('msg' => 'sub_menu data missing', 'desc' => '缺失子菜单数据'),
        41008 => array('msg' => 'missing code', 'desc' => '缺失code参数'),
        41009 => array('msg' => 'missing openid', 'desc' => '缺失openid参数'),
        41010 => array('msg' => 'missing url', 'desc' => '缺失url参数'),
        42001 => array('msg' => 'access_token expired', 'desc' => 'access_token超时'),
        42002 => array('msg' => 'refresh_token expired', 'desc' => 'refresh_token超时'),
        42003 => array('msg' => 'code expired', 'desc' => 'code超时'),
        43001 => array('msg' => 'require GET method', 'desc' => '需要使用GET方法请求'),
        43002 => array('msg' => 'require POST method', 'desc' => '需要使用POST方法请求'),
        43003 => array('msg' => 'require https', 'desc' => '需要使用HTTPS'),
        43004 => array('msg' => 'require subscribe', 'desc' => '需要订阅关系'),
        44001 => array('msg' => 'empty media data', 'desc' => '空白的二进制数据'),
        44002 => array('msg' => 'empty post data', 'desc' => '空白的POST数据'),
        44003 => array('msg' => 'empty news data', 'desc' => '空白的news数据'),
        44004 => array('msg' => 'empty content', 'desc' => '空白的内容'),
        44005 => array('msg' => 'empty list size', 'desc' => '空白的列表'),
        45001 => array('msg' => 'media size out of limit', 'desc' => '二进制文件超过限制'),
        45002 => array('msg' => 'content size out of limit', 'desc' => 'content参数超过限制'),
        45003 => array('msg' => 'title size out of limit', 'desc' => 'title参数超过限制'),
        45004 => array('msg' => 'description size out of limit', 'desc' => 'description参数超过限制'),
        45005 => array('msg' => 'url size out of', 'desc' => 'limit	url参数长度超过限制'),
        45006 => array('msg' => 'picurl size out of limit', 'desc' => 'picurl参数超过限制'),
        45007 => array('msg' => 'playtime out of', 'desc' => 'limit	播放时间超过限制（语音为60s最大）'),
        45008 => array('msg' => 'article size out of limit', 'desc' => 'article参数超过限制'),
        45009 => array('msg' => 'api freq out of limit', 'desc' => '接口调动频率超过限制'),
        45010 => array('msg' => 'create menu limit', 'desc' => '建立菜单被限制'),
        45011 => array('msg' => 'api limit', 'desc' => '频率限制'),
        45012 => array('msg' => 'template size out of limit', 'desc' => '模板大小超过限制'),
        45016 => array('msg' => "can't modify sys group", 'desc' => '不能修改默认组'),
        45017 => array('msg' => "can't set group name too long sys group", 'desc' => '修改组名过长'),
        45018 => array('msg' => 'too many group now, no need to add new', 'desc' => '组数量过多'),
        50001 => array('msg' => 'api unauthorized', 'desc' => '接口未授权')
    );

    /**
     * 异常处理
     *
     * @param mix $err
     * @return array
     */
    public static function handle($err)
    {
        if (isset(self::$codeList[$err['code']])) {
            return array('code' => $err['code'], 'msg' => $err['msg'], 'desc' => self::$codeList[$err['code']]['desc']);
        }
        return $err;
    }
}