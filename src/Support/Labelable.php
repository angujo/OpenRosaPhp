<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;

trait Labelable
{
    /** @var null|ValueTag */
    private $_label = null;

    /**
     * @return null
     */
    public function getLabel()
    {
        return $this->_label ? $this->_label->getValue() : null;
    }

    /**
     * @param null $label
     *
     * @return Translation
     * @throws OException
     */
    public function setLabel($label)
    {
        if ($this->_label) {
            $this->_label->setValue($label);
        } else {
            $this->_label = new ValueTag('label', $label);
        }
        return $this->_label->getTranslation();
    }

}