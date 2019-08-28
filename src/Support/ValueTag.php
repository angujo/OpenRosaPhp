<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\ODKForm;

class ValueTag extends XMLTag
{
    private $translation;

    public function __construct($tag, $default)
    {
        parent::__construct($tag);
        $this->content     = $default;
        $this->translation = new Translation($default);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->translation->getDefault();
    }

    /**
     * @param mixed $value
     *
     * @return Translation
     * @throws OException
     */
    public function setValue($value)
    {
        $this->content = $value;
        return $this->translation->setDefault($value);
    }

    /**
     * @return Translation
     */
    public function getTranslation(): Translation
    {
        return $this->translation;
    }

}