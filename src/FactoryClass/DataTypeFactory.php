<?php
namespace MicroService\FactoryClass;

use MicroService\AbstractClass\CallChannel;

/**
 * 类型工厂
 * Class DataTypeFactory
 * @package MicroService\Logics
 */
class DataTypeFactory
{
    public static function get_instance($type)
    {
        $type = ucfirst($type);
        $namespace = "MicroService\\Logics\\";
        $reflection = new \ReflectionClass($namespace . $type . 'Channel');
        $object = $reflection->newInstance();
        if (!($object instanceof CallChannel)) {
            throw new \Exception('NOT CORRECT channel TYPE');
        }
        return $object;
    }
}