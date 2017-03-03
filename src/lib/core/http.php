<?php
namespace jzweb\open\weixin\lib\core;

/**
 * 封装http怕请求接口
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/3
 */
class http
{

    /**
     * 实现GET请求
     *
     * @param string $url
     * @param array $header
     * @param string $body
     *
     * @return mix
     */
    public static function get($url, $header = [], $body = "")
    {

        try {
            $client = new \GuzzleHttp\Client();
            if ($header) {
                $response = $client->get($url)->getBody()->getContents();
            } else {
                $response = $client->get($url, ['headers' => $header, 'body' => $body])->getBody()->getContents();
            }
            if (!$response) {
                return exception::handle(array('code' => 0, 'msg' => "返回的内容为空", 'desc' => "返回的内容为空"));
            }
            // 转化数据格式
            $data = json_decode($response, true);
            if (is_array($data) && isset($data['errcode'])) {
                return exception::handle(array('code' => $data['errcode'], 'msg' => $data['errmsg']));
            }
            // 返回结果
            return $data;
        } catch (\Exception $e) {
            return exception::handle(array('code' => $e->getCode(), 'msg' => $e->getMessage(), 'desc' => "系统发生异常"));
        }
    }
}