<?php
namespace MicroService\ConfigClass;

/**
 * 消息发送配置参数配置类
 * Class MsgSenderConfig
 * @package MicroService\ConfigClass
 */
class MsgSenderConfig{
    //接收者
    public $receiver='';
    //模板id
    public $template_id='';
    //参数
    public $args=[];
    //消息通道（如短信：云融、创蓝...）
    public $channel='';
    //账号
    public $account='';
    //消息类型(营销、通知...)
    public $type='';
    //批次号
    public $batch_id='';
    //发送时间
    public $send_time='';
    //使用swoole自身的定时器进行发送(24小时以内)
    public $self_send_time='';
    //扩展字段
    public $ext=[];
}