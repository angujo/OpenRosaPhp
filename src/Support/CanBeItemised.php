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
    public function addOption($value, $label, $index = null)
    {
        $this->addElementUnq($option = Option::create($value, $label, $index), $value);
        if (!$index) {//->setRef(explode('/', implode('/', $this->fullNodeSet()).$ref));
            $ref = ':option'.count($this->getOptions()) - 1;
            $option->setRef($ref);
        }
        if ($this->fullRef()) {
            $option->setNodeset($this->fullRef());
        }
        return $this;
    }

    /**
     * @param Option[]|string[] $options
     *
     * @return static
     * @throws OException
     */
    public function setOptions(array $options)
    {
        foreach ($options as $value => $option) {
            if (!is_a($option, Option::class)) {
                $this->addElementUnq($option, $option->getValue());
            } else {
                $this->addOption((string)$value, (string)$option);
            }
        }
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