<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;

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

    protected function fullNodeSet()
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
    public function setNodeset(array $nodeset)
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


    public function getFullNodeset()
    {
        return implode('/', $this->fullNodeSet());
    }

    protected function relativeNodeset()
    {
        return '/'.$this->getFullNodeset();
    }

    private function nodeset()
    {
        $this->trickleDown();
        $this->addAttribute('nodeset', $this->relativeNodeset());
        if (Config::isODK()) {
            $this->checkOnTranslation($this, $this->fullNodeSet());
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