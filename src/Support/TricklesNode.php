<?php


namespace Angujo\OpenRosaPhp\Support;


/**
 * Trait TricklesNode
 *
 * @package Angujo\OpenRosaPhp\Support
 */
trait TricklesNode
{
    protected function trickleDown()
    {
        foreach ($this->elements as $element) {
            if (method_exists($element, 'setNodeset') && (method_exists($this, 'fullNodeSet') || method_exists($this, 'fullRef'))) {
                $element->setNodeset(method_exists($this, 'fullNodeSet') ? $this->fullNodeSet() : $this->fullRef());
            }
        }
    }
}