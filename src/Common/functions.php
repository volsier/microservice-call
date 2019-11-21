<?php
/**
 * get msg-center config
 * @param $key
 * @return mixed
 */
function msg_config($key)
{
    $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';
    if (file_exists($file)) {
        $config = require $file;
    } else {
        exit('config file not exist');
    }
    return $config[$key];
}

/**
 * get unique id
 * @return string
 */
function msg_get_uniqid()
{
    $prefix = mt_rand();
    $time = time();
    return crc32(uniqid($prefix, true)) . $time;
}

/**
 * 获取消息中心的env
 * @return string
 */
function get_msg_center_env()
{
    $env_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'env';
    $content = trim(file_get_contents($env_file));
    return $content;
}

/**
 * 是否是有效的timestamp
 * @param $timestamp
 * @return bool
 */
function msg_is_valid_timeStamp($timestamp)
{
    return ((string) (int) $timestamp == $timestamp)
    && ($timestamp <= PHP_INT_MAX)
    && ($timestamp >= ~PHP_INT_MAX);
}

