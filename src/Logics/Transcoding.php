<?php
namespace MicroService\Logics;
use MicroService\AbstractClass\TranscodingAbstract ;
use MicroService\Hooks\MsgHook;

/**
 * 转码处理
 * Class Transcoding
 * @package MicroService\Logics
 */
class Transcoding extends TranscodingAbstract
{
    /**
     * 发送消息
     * @return mixed
     */
    public function send()
    {
        $push_data = $this->get_params();
        $push_queue = 'micro_service_call:transcoding:queue';
        $push = compact('push_data', 'push_queue');
        $res = $this->instance->push($push);
        if($res){
            MsgHook::event('transcoding',$push_data);
        }
        return $res;
    }

    /**
     * 获取数据
     * @return array
     */
    private function get_params()
    {
        $url = $this->config->url;
        $callback_url = $this->config->callback_url;
        $args = $this->config->args;
        $channel = $this->config->channel;
        $account = $this->config->account;
        $type = $this->config->type;
        $batch_id = $this->config->batch_id;
        $send_time = $this->config->send_time;
        $self_send_time = $this->config->self_send_time;
        $ext = $this->config->ext;

        $job_data = compact('url',  'callback_url',  'args', 'channel', 'account', 'type', 'batch_id', 'send_time', 'self_send_time', 'ext');
        $job_name = 'transcoding';
        $job_time = date('Y-m-d H:i:s', time());
        $job_id = msg_get_uniqid();

        return compact('job_name', 'job_data', 'job_time', 'job_id');
    }
}