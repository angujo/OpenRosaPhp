<?php


namespace Angujo\OpenRosaPhp\Support;


/**
 * Trait CanBeRef
 *
 * @package Angujo\OpenRosaPhp\Support
 */
trait CanBeRef
{
    protected $_ref;
    protected $_nodeset = [];

    /**
     * @return mixed
     */
    public function getRef()
    {
        return $this->_ref;
    }

    protected function fullRef()
    {
        $fn = $this->_nodeset;
        if ($this->_ref) {
            $fn[] = $this->_ref;
        }
        return $fn;
    }

    public function setNodeset(array $nodeset)
    {
        $this->_nodeset = $nodeset;
        $this->ref();
        return $this;
    }

    /**
     * @param mixed $ref
     *
     * @return CanBeRef
     */
    public function setRef($ref)
    {
        $this->_ref = $ref;
        $this->ref();
        return $this;
    }

    public function getFullRef()
    {
        if (property_exists($this, 'merge_ref') && $this->merge_ref) {
            return implode('/', $this->_nodeset).$this->_ref;
        }
        return implode('/', $this->fullRef());
    }

    private function ref()
    {
        $this->trickleDown();
        $this->addAttribute('ref', strtolower($this->getFullRef()));
    }
}