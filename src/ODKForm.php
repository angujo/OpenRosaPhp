<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Models\Body;

/**
 * Class ODKForm
 *
 * @package Angujo\OpenRosaPhp
 */
class ODKForm
{
    private static $_dom_document;
    private static $_body;

    protected static function getDomDocument()
    {
        return self::$_dom_document = self::$_dom_document ?: new \DOMDocument('1.0', 'UTF-8');
    }

    public static function get()
    {
        return self::getDomDocument();
    }

    public static function setInstanceName($data_name = 'data')
    {
        return self::body()->setRef((string)$data_name);
    }

    public static function body()
    {
        if (!self::$_body) {
            self::$_body = new Body();
            self::setInstanceName();
        }
        return self::$_body;
    }

    /**
     * @return string
     * @throws Core\OException
     */
    public static function toXML()
    {
        self::body()->toXML(self::getDomDocument());
        return self::getDomDocument()->saveXML();
    }
}