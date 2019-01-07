<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 2019-01-07
 * Time: 12:50 PM
 */

namespace Angujo\OpenRosaPhp\Libraries;


/**
 * Class Xpath
 * @package Angujo\OpenRosaPhp\Libraries
 *
 *          This class holds all paths assuming each has a unique name.
 */
class Xpath
{
    /** @var string[] */
    private static $paths = [];
    
    public static function setPath($path)
    {
        self::$paths[basename($path)] = $path;
    }
    
    public static function getPath($basename)
    {
        $basename = basename($basename);
        return self::$paths[$basename] ?? NULL;
    }
}