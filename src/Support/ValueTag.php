<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\ODKForm;

class ValueTag extends XMLTag
{
    private $translation;

    public function __construct($tag, $default, $no_trans = false)
    {
        parent::__construct($tag);
        $this->content = $default;
        if (false === $no_trans) {
            $this->translation = new Translation($default);
        }
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->translation ? $this->translation->getDefault() : $this->content;
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
        return $this->translation ? $this->translation->setDefault($value) : null;
    }

    /**
     * @return Translation|null
     */
    public function getTranslation(): Translation
    {
        return $this->translation;
    }

}