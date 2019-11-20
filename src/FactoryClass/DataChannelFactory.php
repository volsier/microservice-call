<?php
namespace MicroService\FactoryClass;

use MicroService\AbstractClass\CallChannel;

/**
 * 类型工厂
 * Class DataTypeFactory
 * @package MicroService\Logics
 */
class DataChannelFactory
{
    public static function get_instance($driver)
    {
        $key = $driver['key'];
        $config = $driver['config'];
        $key = ucfirst($key);
        $namespace = "MicroService\\Logics\\";
        $reflection = new \ReflectionClass($namespace . $key . 'Channel');
        $object = $reflection->newInstance($config);
        if (!($object instanceof CallChannel)) {
            throw new \Exception('NOT CORRECT channel TYPE');
        }
        return $object;
    }
}