<?php
namespace core;

use core\Config;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class Container
{
    /**
     * 获取mysql操作对象实例
     * @param string $schema
     * @return \FluentPDO
     */
    public static $db;

    public static function getMysql($schema = 'default')
    {
        $config = Config::getConfig('mysql');
        $config = $config[$schema];
        if (empty(self::$db[$schema])) {
            $dsn = 'mysql:dbname=' . $config['database'] . ';host=' . $config['host'] . ';port:3310;charset=' . $config['charset'];
            $pdo = new \PDO($dsn, $config['username'], $config['password']);
            self::$db[$schema] = new \FluentPDO($pdo);
        }
        return self::$db[$schema];
    }

    public static function log($type, $log)
    {
        $logger = new Logger('my_logger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        switch ($type) {
            case 'info':
                $logger->info($log);
                break;
            case 'error':
                $logger->error($log);
                break;
            default:
                break;
        }
    }

    //获取redis
    public static function getRedis()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', '6379');
        return $redis;
    }


}
