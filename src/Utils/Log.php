<?php
/**
 * Logging
 * @authors Your Name (you@example.org)
 * @date    2018-12-06 08:49:52
 * @version 1.0.0
 */
namespace Angujo\OpenRosaPhp\Utils;

class Log  {
    /** @var Log */
    private static $me;
    /** @var \Closure */
    private $exLogger;

    private function __construct(){
        
    }

    /**
     * @return Log
     */
    private static function init(){
        return self::$me=self::$me?:new self();
    }

    public static function debug(\Closure $closure)
    {
        self::init()->exLogger=$closure;
    }

    protected static function setLog($type,$message)
    {
        if (!self::init()->exLogger || !\is_callable(self::init()->exLogger)) {
           return;
        }
        $msg=date('Y-m-d H:m:s').' '.'['.$type.'] '.$message;
        call_user_func(self::init()->exLogger,$msg);
    }

    public static function info($message)
    {
        self::setLog('INFO',$message);
    }

    public static function error($message)
    {
        self::setLog('ERROR',$message);
    }

    public static function message($message)
    {
        self::setLog('MESSAGE',$message);
    }
}