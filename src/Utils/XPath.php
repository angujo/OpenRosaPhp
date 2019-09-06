<?php


namespace Angujo\OpenRosaPhp\Utils;


/**
 * Class XPath
 *
 * @package Angujo\OpenRosaPhp\Utils
 */
class XPath
{
    private static $paths = [];

    private function __construct(){ }

    public static function setAbsolutePath($path)
    {
        self::$paths[basename($path)] = $path;
    }

    public static function setPath($ref, $full_node)
    {
        self::$paths[$ref] = implode('/', array_merge([$ref], is_array($full_node) ? $full_node : [$full_node]));
    }

    public static function getPath($ref = null)
    {
        if (null === $ref) {
            return self::$paths;
        }
        return isset(self::$paths[$ref]) ? self::$paths[$ref] : null;
    }
}