<?php


namespace Angujo\OpenRosaPhp\Core;


/**
 * Class DOMLayer
 *
 * @package Angujo\OpenRosaPhp\Core
 */
abstract class DOMLayer
{
    /** @var \DOMDocument[]|\DOMElement[] */
    private static $_dom_document;

    protected static function getDomDocument()
    {
        $key = md5(get_called_class());
        if (empty(self::$_dom_document)) {
            self::$_dom_document = new \DOMDocument('1.0', 'utf-8');
        }
        return self::$_dom_document;
    }
}