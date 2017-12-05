<?php
namespace jzweb\open\weixin\lib;

use jzweb\open\weixin\lib\core\http;
use jzweb\open\weixin\lib\wxBiz\WXBizMsgCrypt;

/**
 * 微信小程序
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/2
 */
class wxa
{

    private $getSessionKeyUrl = "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code";


    /**
     * code 换取 session_key
     * ​这是一个 HTTPS 接口，开发者服务器使用登录凭证 code 获取 session_key 和 openid。
     * session_key 是对用户数据进行加密签名的密钥。为了自身应用安全，session_key 不应该在网络上传输。
     *
     * @param string $app_id 小程序唯一标示
     * @param string $secret 小程序的 app secret
     * @param string $code 登录时获取的 code
     * @param string $grant_type 填写authorization_code
     *
     * 正常返回的JSON数据包
     *      {
     *          "openid": "OPENID",
     *          "session_key": "SESSIONKEY",
     *          "unionid": "UNIONID"
     *      }
     * 错误时返回JSON数据包(示例为Code无效)
     *      {
     *          "errcode": 40029,
     *          "errmsg": "invalid code"
     *      }
     *
     * @return array
     */
    public function getAccessTokenByCode($app_id, $secret, $js_code, $grant_type = "authorization_code")
    {
        $requestUrl = sprintf($this->getSessionKeyUrl, $app_id, $secret, $js_code, $grant_type);
        return http::get($requestUrl);
    }

    /**
     * 对微信小程序用户加密数据的解密示例代码
     *
     * @param string $appid
     * @param string $sessionKey
     * @param string $encryptedData
     * @param string $iv
     * @param array $data
     * @return array
     */
    public function decryptData($appid, $sessionKey, $encryptedData, $iv,&$data)
    {
        $errCode = WXBizMsgCrypt::decryptWXAData($appid,$sessionKey,$encryptedData, $iv, $data);
        if ($errCode == 0) {
            $data= json_decode($data,true);
            return true;
        } else {
            return false;
        }

    }


}