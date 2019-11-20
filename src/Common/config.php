<?php
return [
    'develop_redis' => [
        'host' => '127.0.0.1',
        'password' => 'rQBhGv8ov@uBCvh1',
        'port' => 6379,
        'select_num' => 10,
    ],

    'release_redis' => [
        'host' => config('apiconfig.micro_redis.host', '127.0.0.1'),
        'password' => config('apiconfig.micro_redis.password', null),
        'port' => config('apiconfig.micro_redis.port', 6379),
        'select_num' => config('apiconfig.micro_redis.select_num', 10),
    ],

    'driver' => 'Redis',

    //钩子注册
    'hooks' => [
        //短信发送成功
        'sms_sent' => [
            'MicroService\Hooks\Test',
            'MicroService\Hooks\Test2',
        ],
        //转码发送成功
        'transcoding' => [
            'MicroService\Hooks\Test',
            'MicroService\Hooks\Test2',
        ],
        //语音发送成功
        'voice_sent' => [
            'MicroService\Hooks\Test',
            'MicroService\Hooks\Test2',
        ],
        //push发送成功
        'push_sent' => [
            'MicroService\Hooks\Test',
            'MicroService\Hooks\Test2',
        ],
    ],
];