<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Models\XForm;
use Angujo\OpenRosaPhp\Models\XFormsGroup;

/**
 * Class FormsList
 *
 * @package Angujo\OpenRosaPhp
 */
class FormsList
{
    /** @var \DOMDocument|\DOMElement */
    private static $_dom_document;
    /** @var \DOMDocument|\DOMElement */
    private static $_dom_xforms;
    /** @var XMLTag[] */
    private static $xforms = [];

    private static function xFormsDOM()
    {
        if (self::$_dom_xforms) {
            return self::$_dom_xforms;
        }
        self::$_dom_xforms = self::getDomDocument()->createElement('xforms');
        self::$_dom_xforms->setAttribute('xmlns', 'http://openrosa.org/xforms/xformsList');
        self::getDomDocument()->appendChild(self::$_dom_xforms);
        return self::$_dom_xforms;
    }

    public static function getDomDocument()
    {
        if (!self::$_dom_document) {
            self::$_dom_document = new \DOMDocument('1.0', 'utf-8');
        }
        return self::$_dom_document;
    }

    /**
     * @param $id
     *
     * @return XForm
     * @throws Core\OException
     */
    public static function addForm($id)
    {
        $form           = new XForm($id);
        self::$xforms[] = &$form;
        return $form;
    }

    /**
     * @param $id
     *
     * @return XFormsGroup
     * @throws Core\OException
     */
    public static function addFormsGroup($id)
    {
        $form           = new XFormsGroup($id);
        self::$xforms[] = &$form;
        return $form;
    }

    /**
     * @return string
     * @throws Core\OException
     */
    public function toXML()
    {
        foreach (self::$xforms as $xform) {
            $xform->toXML(self::xFormsDOM(), self::getDomDocument());
        }
        return self::getDomDocument()->saveXML();
    }
}