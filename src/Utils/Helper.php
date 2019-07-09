<?php


namespace Angujo\OpenRosaPhp\Utils;


use Angujo\OpenRosaPhp\Core\OException;

class Helper
{
    public static function validateTagName($name)
    {
        if (!preg_match('/^([a-z][a-z0-9\-]+[a-z0-9])$/i', $name)) {
            throw new OException($name.' is Invalid attribute/tag name!');
        }
    }
}