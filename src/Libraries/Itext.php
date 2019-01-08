<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 6:02 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;

/**
 * Translations holder
 * Class Itext
 * @package Angujo\OpenRosaPhp\Libraries
 */
class Itext extends Tag
{
    /** @var Itext Only one of me */
    private static $me;
    
    protected function __construct() { parent::__construct(Elmt::ITEXT, NULL); }
    
    public static function create()
    {
        return self::$me = self::$me ?: new self();
    }
    
    public static function add($abbr, $text, $xpath, $id = NULL)
    {
        return self::create()->_add($abbr, $text, $xpath, $id);
    }
    
    public static function addTranslation(Translation $translation, $id = NULL)
    {
        return self::add($translation->getLanguage()->getIsoAbbreviation(), $translation->getTranslation(), $translation->getPath(), $id);
    }
    
    public static function addAll(array $items, $xpath)
    {
        foreach ($items as $lang => $item) {
            self::add($lang, $item, $xpath);
        }
    }
    
    private function _add($abbr, $text, $xpath, $id = NULL)
    {
        if (!($lang = Language::get($abbr))) return NULL;
        if (!($translation = $this->getUniqueTag($abbr))) {
            $translation = $this->identifiedTag(Tag::raw(Elmt::TRANSLATION, NULL), $abbr);
            $translation->setAttribute('lang', $lang->getName());
            if ($lang->isDefault()) $translation->setAttribute('default', 'true()');
        }
        $id = $id ?: uniqid('cstmtrns', TRUE);
        if (!($text_ = $translation->getUniqueTag($id))) {
            $text_ = $translation->identifiedTag(Tag::raw(Elmt::TEXT, NULL), $id);
        }
        $text_->setAttribute('id', $xpath);
        $text_->addUniqueTag(Elmt::VALUE, $text);
        return $id;
    }
}