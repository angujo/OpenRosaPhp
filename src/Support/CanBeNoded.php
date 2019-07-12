<?php


namespace Angujo\OpenRosaPhp\Support;


/**
 * Trait CanBeNoded
 *
 * @package Angujo\OpenRosaPhp\Support
 */
trait CanBeNoded
{
    protected $_nodeset = [];
    protected $_ref;

    /**
     * @return array
     */
    public function getNodeset(): array
    {
        return $this->_nodeset;
    }

    private function fullNodeSet()
    {
        $fn = $this->_nodeset;
        if ($this->_ref) {
            $fn[] = $this->_ref;
        }
        return $fn;
    }

    /**
     * @param array $nodeset
     *
     * @return CanBeNoded
     */
    public function setNodeset(array $nodeset): CanBeNoded
    {
        $this->_nodeset = $nodeset;
        $this->nodeset();
        return $this;
    }

    /**
     * @param mixed $ref
     *
     * @return CanBeNoded
     */
    public function setRef($ref)
    {
        $this->_ref = $ref;
        $this->nodeset();
        return $this;
    }

    private function trickleDown()
    {
        foreach ($this->elements as $element) {
            if (method_exists($element, 'setNodeset')) {
                $element->setNodeset($this->fullNodeSet());
            }
        }
    }

    public function getFullNodeset()
    {
        return implode('/', $this->fullNodeSet());
    }

    private function nodeset()
    {
        $this->trickleDown();
        $this->addAttribute('nodeset', $this->getFullNodeset());
    }
}