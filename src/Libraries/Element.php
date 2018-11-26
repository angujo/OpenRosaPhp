<?php

namespace Angujo\OpenRosaPhp\Libraries;

/**
 * Hold Element
 * @authors bangujo
 * @date    2018-11-26 13:12:12
 * @version 1.0.0
 */

class Element
{

    /** @var string */
    private $name;
    /** @var string */
    private $value;
    /** @var Element[] */
    private $children = [];

    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public static function set($name, $value = null)
    {
        return new self($name, $value);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of children
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set the value of children
     *
     * @return  self
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    public function addChild(Element $element, $id)
    {
         return $this->children[$id] = $element;
    }
}
