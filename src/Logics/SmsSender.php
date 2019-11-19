<?php
namespace MicroService\Logics;
use MicroService\AbstractClass\MsgSender;
use MicroService\Hooks\MsgHook;

/**
 * 短信发送
 * Class SmsSender
 * @package MicroService\Logics
 */
class SmsSender extends MsgSender
{
    /**
     * 发送消息
     * @return mixed
     */
    public function send()
    {
        $push_data = $this->get_params();
        $push_queue = 'msgcenter:sms:queue';
        $push = compact('push_data', 'push_queue');
        $res = $this->instance->push($push);
        if($res){
            MsgHook::event('sms_sent',$push_data);
        }
        return $res;
    }

    /**
     * 获取数据
     * @return array
     */
    private function get_params()
    {
        $receiver = $this->config->receiver;
        $template_id = $this->config->template_id;
        $args = $this->config->args;
        $channel = $this->config->channel;
        $account = $this->config->account;
        $type = $this->config->type;
        $batch_id = $this->config->batch_id;
        $send_time = $this->config->send_time;
        $self_send_time = $this->config->self_send_time;
        $ext = $this->config->ext;

        $job_data = compact('receiver', 'template_id', 'args', 'channel', 'account', 'type', 'batch_id', 'send_time', 'self_send_time', 'ext');
        $job_name = 'sms';
        $job_time = date('Y-m-d H:i:s', time());
        $job_id = msg_get_uniqid();

        return compact('job_name', 'job_data', 'job_time', 'job_id');
    }
}