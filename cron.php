<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/6
 * Time: 下午6:45
 */
//如果是cli模式下
if (php_sapi_name() == 'cli') {
    require __DIR__ . '/vendor/autoload.php';
    function serviceAutoload($className)
    {
        $nameArr = explode('\\', $className);
        if ($nameArr[0] == 'cron') {
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $nameArr) . '.php';
            if (file_exists($filePath)) {
                require_once $filePath;
                return true;
            }
        } else if ($nameArr[0] == 'core') {
            $filePath = __DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $nameArr) . '.php';
            if (file_exists($filePath)) {
                require_once $filePath;
                return true;
            }
        }
        return false;
    }

    spl_autoload_register("serviceAutoload");
    $argv = $_SERVER['argv'];
    if ($argc >= 2) {
        $className = $argv[1];
        $cronClass = new $className;
    } else {
        echo "请指定要执行的类";
    }
}



