<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 10:13 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;


use Angujo\OpenRosaPhp\Models\Config;

class Translation
{
    /** @var Language */
    private $language;
    /** @var string */
    private $translation;
    /** @var string */
    private $path;
    private $id;

    public function __construct(Language $language, $translation,$id)
    {
        $this->language = $language;
        $this->translation = $translation;
        $this->id=$id;
    }

    public static function set($lang, $translation,$id)
    {
        if (!\is_object($lang) && \is_string($lang)) {
            if (!($language = Language::get($lang))) {
                if (!($set = Data::languages($lang))) return null;
                $language = Language::add(array_keys($set)[0], array_values($set)[0]);
            }
            $lang = $language;
        }
        return new self($lang, $translation,$id);
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @param Language $language
     * @return Translation
     */
    public function setLanguage(Language $language): Translation
    {
        $this->language = $language;
        if (Config::isOdk()) $this->id = Itext::addTranslation($this, $this->id);
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
     * @return Translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;
        if (Config::isOdk()) $this->id = Itext::addTranslation($this, $this->id);
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Translation
     */
    public function setPath($path)
    {
        $this->path = $path;
        if (Config::isOdk()) $this->id = Itext::addTranslation($this, $this->id);
        return $this;
    }

}