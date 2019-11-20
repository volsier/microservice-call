<?php

namespace MicroService\Logics;

use MicroService\AbstractClass\CallChannel;
use Redis;

/**
 * redis
 * Class RedisData
 * @package MicroService\Logics
 */
class RedisChannel extends CallChannel
{
    private $redis;
    private $redis_num;

    public function __construct()
    {
        $this->init_redis();
    }

    /**
     * 初始化redis
     * @throws \Exception
     */
    private function init_redis()
    {
        if (!class_exists('Redis')) {
            throw new \Exception('PHP Redis not installed');
        }
        $this->redis = new Redis();
        $env = get_msg_center_env();
        $redis_config = msg_config($env . "_redis");
        $this->redis_num = $redis_config('select_num') ?? 10;
        $this->redis::connect($redis_config['host'], $redis_config['port']);
        if (!empty($redis_config['password'])) {
            $this->redis::auth($redis_config['password']);
        }
    }

    /**
     * 发送
     * @param $data
     * @return bool
     */
    public function push($data)
    {
        if (!empty($data['push_queue']) && !empty($data['push_data'])) {
            $queue_name = $data['push_queue'];
            $queue_data = $data['push_data'];
            $queue_data = $this->combine_data($queue_data);
            $this->redis::select($this->redis_num);
            $response = $this->redis::rpush($queue_name, $queue_data);
            $this->redis::select(0);
            return $response;
        }
        return false;
    }

    /**
     * 组合数据
     * @param $push_data
     * @return string
     */
    public function combine_data($push_data)
    {
        $queue_data = [
            'job_name' => $push_data['job_name'],
            'data' => $push_data['job_data'],
            'create_at' => $push_data['job_time'],
            'id' => $push_data['job_id']
        ];
        return json_encode($queue_data);
    }
}
