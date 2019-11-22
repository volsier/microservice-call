<?php
namespace MicroService\ConfigClass;

/**
 * 参数配置类
 * Class TranscodingConfig
 * @package MicroService\ConfigClass
 */
class TranscodingConfig{
    //文件地址
    public $url='';
    //回调地址
    public $callback_url='';
    //参数
    public $args=[];
    //需要存储到的位置类型（如七牛，阿里云cdn，本地...）
    public $channel='';
    //账号
    public $account='';
    //处理类型(高清、标清...)
    public $type='';
    //批次号
    public $batch_id='';
    //发送时间
    public $send_time='';
    //使用swoole自身的定时器进行发送(24小时以内)
    public $self_send_time='';
    //沟通微服务渠道配置
    public $driver=[];
    //扩展字段
    public $ext=[];

    public function __construct($driver)
    {
        $this->driver = $driver;
    }
}