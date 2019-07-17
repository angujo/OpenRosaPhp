<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Models\Body;
use Angujo\OpenRosaPhp\Models\Head;
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
    /** @var Body */
    private static $_body;
    /** @var Head */
    private static $_head;
    private static $_title = 'Untitled Form';
    private static $_data = 'data';

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
        self::$_html_document->setAttribute('xmlns', NS::XMLNS);
        self::getDomDocument()->appendChild(self::$_html_document);
        return self::$_html_document;
    }

    public static function get()
    {
        return self::getDomDocument();
    }

    public static function setInstanceName(&$data_name = 'data')
    {
        self::$_data = $data_name;
        return self::body()->setNodeset([$data_name]);
    }

    public static function body()
    {
        if (!self::$_body) {
            self::$_body = new Body();
            self::setInstanceName();
        }
        return self::$_body;
    }

    public static function head()
    {
        if (!self::$_head) {
            self::$_head = new Head(self::$_data, self::$_title);
            self::setInstanceName();
        }
        return self::$_head;
    }

    /**
     * @return string
     * @throws Core\OException
     */
    public static function toXML()
    {
        self::head()->setPrimaryInstance();
        self::head()->toXML(self::getHTMLDom());
        self::body()->toXML(self::getHTMLDom());
        return self::getDomDocument()->saveXML();
    }
}