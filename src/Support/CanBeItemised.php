<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Models\Option;

trait CanBeItemised
{
    /**
     * @param $value
     *
     * @return Option
     */
    public function getOption($value)
    {
        return $this->getElement($value);
    }

    /**
     * @param $value
     * @param $label
     *
     * @return $this
     * @throws OException
     */
    public function addOption($value, $label)
    {
        $this->addElementUnq(Option::create($value, $label), $value);
        return $this;
    }

    /**
     * @return Option[]
     */
    public function getOptions()
    {
        return $this->getElements();
    }
}