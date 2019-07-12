<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;

class Translation
{
    private $translations = [];
    private $def = 'en';

    /**
     * Translation constructor.
     *
     * @param $value
     *
     * @throws OException
     */
    public function __construct($value)
    {
        $this->addTranslation($this->def, $value);
    }

    /**
     * @param string $def
     *
     * @return Translation
     * @throws OException
     */
    public function setDefault(string $def)
    {
        return $this->addTranslation($this->def, $def);
    }

    public function getDefault()
    {
        return $this->translations[$this->def] ?? null;
    }

    /**
     * @param $lang_iso
     * @param $value
     *
     * @return $this
     * @throws OException
     */
    public function addTranslation(string $lang_iso, $value)
    {
        if (null === $value) {
            return $this;
        }
        if (!is_string($lang_iso) || (!is_string($value.'') && !is_numeric($value))) {
            throw new OException('Languages should be alphanumeric with String translations!');
        }
        $this->translations[$lang_iso] = $value;
        return $this;
    }

    /**
     * @param $lang
     * @param $translation
     *
     * @return Translation
     * @throws OException
     */
    public function __call($lang, $translation)
    {
        return $this->addTranslation($lang, $translation);
    }

    public function __toString()
    {
        return null === $this->getDefault() ? '' : $this->getDefault();
    }
}