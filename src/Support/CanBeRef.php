<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Models\Head;
use Angujo\OpenRosaPhp\Models\Option;
use Angujo\OpenRosaPhp\ODKForm;

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
        return strtolower(implode('/', $this->fullRef()));
    }

    private function relativeRef()
    {
        return '/'.$this->getFullRef();
    }

    private function ref()
    {
        $this->trickleDown();
        $this->addAttribute('ref', $this->relativeRef());
        $fref = $this->getFullRef();
        if (property_exists($this, 'ref_id') && $this->ref_id) {
            if (Config::isODK()) {
                ODKForm::head()->setVariable($this->ref_id, $fref, $this->content);
            }
        }
        if (Config::isODK()) {
            $this->checkOnTranslation($this, $fref);
        }
        if (method_exists($this, 'getBind')) {
            $this->getBind()->setNodeSet($this->relativeRef());
        }
    }

    private function checkOnTranslation($element, $fref)
    {
        if (method_exists($element, 'getLabelElement')) {
            /** @var Translation $trans */
            $this->getLabelElement()->getTranslation()->setNode($fref);
        } elseif (method_exists($element, 'getTranslation')) {
            $this->getTranslation()->setNode($fref);
        }
    }
}