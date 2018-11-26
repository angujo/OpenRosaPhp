<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:54 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;


class TranslationXXX
{
    /** @var Language */
    protected $language;
    /** @var string */
    protected $translation;

    private function __construct(Language $language, $translation)
    {
        $this->setLanguage($language)->setTranslation($translation);
    }

    public static function default($translation): TranslationXXX
    {
        if (!($lang = Language::get(Language::DEF_ABBR))) $lang = Language::create(Language::DEF_ABBR, Language::DEF_NAME);
        return self::create($lang, $translation);
    }

    /**
     * @param Language $language
     * @param $translation
     * @return TranslationXXX
     */
    public static function create(Language $language, $translation)
    {
        return new self($language, $translation);
    }

    /**
     * @param $abbr
     * @param $translation
     * @return TranslationXXX
     * @throws \Exception
     */
    public static function createFromAbbreviation($abbr, $translation)
    {
        if (!($lang = Language::get($abbr))) throw new \Exception('Invalid language abbreviation: "' . $abbr . '"!');
        return self::create($lang, $translation);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return TranslationXXX
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param string $translation
     * @return TranslationXXX
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
        return $this;
    }
}