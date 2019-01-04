<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 7:26 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;

use Angujo\OpenRosaPhp\Config\MyLanguages;
use Angujo\OpenRosaPhp\Libraries\Data;
use Angujo\OpenRosaPhp\Libraries\Language;
use Angujo\OpenRosaPhp\Libraries\Translation;


/**
 * Class LanguageTranslator
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 *
 */
class LanguageTranslator extends MyLanguages
{
    /** @var Translation[] */
    private $translatables = [];
    private $id;


    public function __construct($default)
    {
        $this->id = uniqid('trans', true);
        $this->english($default);
    }

    public static function default($translation)
    {
        return new self($translation);
    }

    /**
     * @param $abbreviation
     * @param $translation
     * @return LanguageTranslator|null
     * @throws \Exception
     */
    public function custom($abbreviation, $translation)
    {
        if (!($language = Language::get($abbreviation))) throw new \Exception("Invalid language abbreviation '$abbreviation'. Ensure language set!");
        return $this->translate($language, $translation);
    }

    /**
     * @param $method
     * @param $args
     * @return LanguageTranslator|null
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (empty($args) || !\is_string($args[0])) throw new \Exception('Invalid translation!');
        if (!($language = $this->validLanguage($method))) {
            if (!isset($args[1]) || !\is_string($args[1])) throw new \Exception("$method is not a valid language. To add own language pass second parameter with ISO abbreviation of the language!");
            $language = Language::add($args[1], $method);
        }
        return $this->translate($language, $args[0]);
    }

    /**
     * @param Language $language
     * @param $translation
     * @return $this|null
     */
    private function translate(Language $language, $translation)
    {
        if (!($trans = Translation::set($language, $translation, $this->id))) return null;
        $this->translatables[$trans->getLanguage()->getIsoAbbreviation()] = $trans;
        return $this;
    }

    private function validLanguage($name, $abbr = null)
    {
        if (($language = Data::languages($name)) || ($language = $this->_get_my_language($name)) || ($language = Language::get($abbr))) {
            Language::set($language);
            return $language;
        }
        return null;
    }

    /**
     * @return Translation[]
     */
    public function translations()
    {
        return $this->translatables;
    }

    public function changePaths($path)
    {
        foreach ($this->translatables as $translatable) {
            $translatable->setPath($path);
        }
    }
}