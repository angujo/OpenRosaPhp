<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Utils\XPath;

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

    protected function nodeset()
    {
        $this->trickleDown();
        $this->addAttribute('nodeset', $this->relativeNodeset());
        if (property_exists($this, 'root') && is_a($this, XMLTag::class)) {
            $this->root->addAttribute('nodeset', $this->relativeNodeset());
        }
        XPath::setAbsolutePath($this->relativeNodeset());
        if (Config::isODK()) {
            $this->checkOnTranslation($this, $this->fullNodeSet());
        }
    }

    private function checkOnTranslation($element, $fref)
    {
        if (method_exists($element, 'getLabelElement')) {
            /** @var Translation $trans */
            $this->getLabelElement()->setNodeset($fref);
        } elseif (method_exists($element, 'getTranslation')) {
            $this->getTranslation()->setNode($fref);
        }
    }
}