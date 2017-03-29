<?php
namespace jzweb\open\weixin\mp;


/**
 * 公众平台-消息被动回复
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/29
 */
class replay
{

    /**
     * 消息别动回复
     *
     * @param string $type 消息回复类型
     * @param arrat $data 消息回复内容¬
     *
     * @return string
     */
    public function buildReplayContent($type, $data)
    {

        switch ($type) {
            case "text":
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayText', $data);
                break;
            case "image":
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayImage', $data);
                break;
            case "voice":
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayVoice', $data);
                break;
            case "video":
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayVideo', $data);
                break;
            case "music":
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayMusic', $data);
                break;
            default:
                return call_user_func_array('\jzweb\open\weixin\lib\replay::replayNews', $data);
                break;
        }
    }

}
