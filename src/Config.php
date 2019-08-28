<?php


namespace Angujo\OpenRosaPhp;


/**
 * Class Config
 *
 * @package Angujo\OpenRosaPhp
 */
class Config
{
    /**
     * Set the running mode,
     * 1=ODK,2=JSON
     *
     * @var int
     */
    private static $mode = 1;

    /**
     * Declare the runtype as ODK
     */
    public static function asODK()
    {
        self::$mode = 1;
    }

    /**
     * Declare the runtype as JSON
     */
    public static function asJSON()
    {
        self::$mode = 2;
    }

    /**
     * Check if runtime is ODK
     *
     * @return bool
     */
    public static function isODK()
    {
        return self::$mode === 1;
    }

    /**
     * Check if runtime is JSON
     *
     * @return bool
     */
    public static function isJSON()
    {
        return self::$mode === 2;
    }
}