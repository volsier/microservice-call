<?php
namespace MicroService\AbstractClass;
/**
 * 调用通道类型抽象类
 * Class DataType
 * @package MicroService\Logics
 */
abstract class CallChannel
{
    abstract public function push($data);
}