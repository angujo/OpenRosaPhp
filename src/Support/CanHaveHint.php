<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;

trait CanHaveHint
{
    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->hasElement('hint') && $this->getElement('hint') ? $this->getElement('hint')->getValue() : null;
    }

    /**
     * @param null $label
     *
     * @return Translation
     * @throws OException
     */
    public function setHint($label)
    {
        if ($this->hasElement('hint')) {
            $this->getElement('hint')->setValue($label);
        } else {
            $this->addElementUnq(new ValueTag('hint', $label));
        }
        return $this->getElement('hint')->getTranslation();
    }

}