<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\Attribute;
use Angujo\OpenRosaPhp\Core\OException;

/**
 * Class TranslatedAttribute
 *
 * @package Angujo\OpenRosaPhp\Support
 */
class TranslatedAttribute extends Attribute
{
    /**
     * @var Translation
     */
    private $translation;

    /**
     * @return Translation
     * @throws OException
     */
    public function getTranslation()
    {
        return $this->translation = $this->translation ?: new Translation(null);
    }

    /**
     * @param mixed $value
     * @param null  $lang_iso
     *
     * @return Attribute|Translation
     * @throws OException
     */
    public function setValue($value, $lang_iso = null)
    {
        if (is_string($lang_iso)) {
            $this->getTranslation()->addTranslation($lang_iso, $value);
        } else {
            $this->getTranslation()->setDefault($value);
        }
        return $this->translation;
    }

    /**
     * @return Translation|mixed
     * @throws OException
     */
    public function getValue()
    {
        return $this->getTranslation();
    }
}