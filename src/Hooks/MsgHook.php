<?php
namespace MicroService\Hooks;
/**
 * 消息中心hook
 * Class DataType
 * @package MicroService\Logics
 */
class MsgHook
{
    public static function event($event, $value = NULL, $callback = NULL)
    {
        static $events;

        if($callback !== NULL)
        {
            if($callback)
            {
                $events[$event][] = $callback;
            }
            else
            {
                unset($events[$event]);
            }

        }
        elseif(isset($events[$event])) // Fire a callback
        {
            foreach($events[$event] as $handler)
            {
                call_user_func([$handler,'go'], $value);
            }
        }
    }
}