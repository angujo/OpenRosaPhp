<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Models\MediaFile;
use Angujo\OpenRosaPhp\Models\XForm;
use Angujo\OpenRosaPhp\Models\XFormsGroup;

/**
 * Class FormsList
 *
 * @package Angujo\OpenRosaPhp
 */
class Manifest
{
    /** @var \DOMDocument|\DOMElement */
    private static $_dom_document;
    /** @var \DOMDocument|\DOMElement */
    private static $_dom_media_files;
    /** @var XMLTag[] */
    private static $mediafiles = [];

    private static function mediaDOM()
    {
        if (self::$_dom_media_files) {
            return self::$_dom_media_files;
        }
        self::$_dom_media_files = self::getDomDocument()->createElement('manifest');
        self::$_dom_media_files->setAttribute('xmlns', 'http://openrosa.org/xforms/xformsManifest');
        self::getDomDocument()->appendChild(self::$_dom_media_files);
        return self::$_dom_media_files;
    }

    public static function getDomDocument()
    {
        if (!self::$_dom_document) {
            self::$_dom_document = new \DOMDocument('1.0', 'utf-8');
        }
        return self::$_dom_document;
    }

    /**
     * @param string|MediaFile $media
     *
     * @return MediaFile
     * @throws Core\OException
     */
    public static function addMediaFile($media)
    {
        $form               = is_a($media, MediaFile::class) ? $media : new MediaFile($media);
        self::$mediafiles[] = &$form;
        return $form;
    }

    /**
     * @return string
     * @throws Core\OException
     */
    public function toXML()
    {
        foreach (self::$mediafiles as $xform) {
            $xform->toXML(self::mediaDOM(), self::getDomDocument());
        }
        return self::getDomDocument()->saveXML();
    }
}