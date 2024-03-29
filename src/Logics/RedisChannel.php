<?php

namespace MicroService\Logics;

use MicroService\AbstractClass\CallChannel;
use Predis\Client;
use Redis;

/**
 * redis
 * Class RedisData
 * @package MicroService\Logics
 */
class RedisChannel extends CallChannel
{
    private $redis;

    public function __construct($config)
    {
        $this->init_redis($config);
    }

    /**
     * 初始化redis
     * @throws \Exception
     */
    private function init_redis($config)
    {
        if (!class_exists('Redis')) {
            throw new \Exception('PHP Redis not installed');
        }

        $this->redis  = new Client($config);;
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
            $response = $this->redis->rpush($queue_name, $queue_data);
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
