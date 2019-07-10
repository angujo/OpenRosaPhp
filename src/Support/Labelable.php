<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;

trait Labelable
{
    /**
     * @return null|string|int
     */
    public function getLabel()
    {
        return $this->hasElement('label') && $this->getElement('label') ? $this->getElement('label')->getValue() : null;
    }

    /**
     * @param null $label
     *
     * @return Translation
     * @throws OException
     */
    public function setLabel($label)
    {
        if ($this->hasElement('label')) {
            $this->getElement('label')->setValue($label);
        } else {
            $this->addElementUnq(new ValueTag('label', $label));
        }
        return $this->getElement('label')->getTranslation();
    }

}