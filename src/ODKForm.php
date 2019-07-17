<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Models\Body;
use Angujo\OpenRosaPhp\Utils\Helper;

/**
 * Class ODKForm
 *
 * @package Angujo\OpenRosaPhp
 */
class ODKForm
{
    private static $_dom_document;
    private static $_html_document;
    private static $_body;

    protected static function getDomDocument()
    {
        return self::$_dom_document = self::$_dom_document ?: new \DOMDocument('1.0', 'UTF-8');
    }

    private static function getHTMLDom()
    {
        if (self::$_html_document) {
            return self::$_html_document;
        }
        self::$_html_document = self::getDomDocument()->createElementNS(NS::url('h'), 'h:html');
        self::getDomDocument()->appendChild(self::$_html_document);
        return self::$_html_document;
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
        self::body()->toXML(self::getHTMLDom());
        return self::getDomDocument()->saveXML();
    }
}