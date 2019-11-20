<?php
return [
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