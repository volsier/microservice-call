<?php
namespace MicroService\AbstractClass;
use MicroService\ConfigClass\TranscodingConfig;
use MicroService\FactoryClass\DataChannelFactory;
use MicroService\Hooks\MsgHook;

use Exception;
use MicroService\InterFaces\MicroServiceCall;

/**
 * 转码调用抽象类
 * Class MsgSender
 * @package MicroService\Logics
 */
abstract class TranscodingAbstract implements MicroServiceCall
{
    protected $driver;
    protected $instance;
    protected $config;

    public function __construct(TranscodingConfig $config)
    {
        $this->driver = $config->driver;
        $this->instance = DataChannelFactory::get_instance($this->driver);
        $this->config = $config;
        $this->check_params($config);
        $this->register_hooks();
    }

    /**
     * 发送
     * @return mixed
     */
    abstract public function send();

    /**
     * 检测参数
     * @param TranscodingConfig $config
     * @throws Exception
     */
    protected function check_params(TranscodingConfig $config)
    {
        $url = $config->url;
        $callback_url = $config->callback_url;
        $args = $config->args;
        $channel = $config->channel;
        $account = $config->account;
        $type = $config->type;
        $send_time = $config->send_time;
        $self_send_time = $config->self_send_time;
        $ext = $config->ext;

        if (empty($url) || empty($callback_url)) {
            throw new Exception("url and callback_url can not be empty!\nCall administrator");
        }

        if (!is_array($args)) {
            throw new Exception("args must be array!\nCall administrator");
        }

        if (!empty($ext) && !is_array($ext)) {
            throw new Exception("ext must be array!\nCall administrator");
        }

        if(!empty($send_time) && !msg_is_valid_timeStamp($send_time)){
            throw new Exception("send time not right!\nCall administrator");
        }

        if(!empty($self_send_time) && !msg_is_valid_timeStamp($self_send_time)){
            throw new Exception("self send time not right!\nCall administrator");
        }

        if (!is_string($url) || !is_string($callback_url) || !is_string($channel) || !is_string($account) || !is_string($type) ) {
            throw new Exception("Params Type NOT RIGHT!\nCall administrator");
        }
    }

    /**
     * 注册Hook
     */
    private function register_hooks(){
        $hooks=msg_config('hooks');
        foreach ($hooks as $hook_name=>$hook_handlers){
            foreach ($hook_handlers as $hook_handler){
                MsgHook::event($hook_name,NULL,$hook_handler);
            }
        }
    }
}