<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Models\Head;
use Angujo\OpenRosaPhp\Models\Option;
use Angujo\OpenRosaPhp\ODKForm;
use Angujo\OpenRosaPhp\Tag;

/**
 * Trait CanBeRef
 *
 * @package Angujo\OpenRosaPhp\Support
 */
trait CanBeRef
{
    protected $_ref;
    protected $full_ref;
    protected $translation_ref;
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

    private function setLabelRef($ref, $trans = false)
    {
        if (true === $trans || ($ref && 0 === strcasecmp(Tag::LABEL, $this->getTag()))) {
            $ref .= 0 !== strcasecmp(':label', substr($ref, -6)) ? ':label' : '';
        }
        return $ref;
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
        return $this->setLabelRef('/'.trim($this->getFullRef(), '/ '));
    }

    private function ref()
    {
        $this->trickleDown();
        $this->full_ref        = $this->relativeRef();
        $this->translation_ref = $this->setLabelRef($this->full_ref,true);
        if (0 === strcasecmp(Tag::LABEL, $this->getTag())) {
            $this->addAttribute('ref', 'jr:itext('.$this->relativeRef().')');
        } else {
            $this->addAttribute('ref', $this->relativeRef());
        }
        if (property_exists($this, 'ref_id') && $this->ref_id) {
            ODKForm::head()->setVariable($this->ref_id, $this->getFullRef(), $this->content);
        }
        if (method_exists($this, 'getBind')) {
            $rel = $this->relativeRef();
            $this->getBind()->setNodeSet($rel);
        }
    }

    private function checkOnTranslation($element, $fref)
    {
        /** @var Translation|null $trans */
        $trans = null;
        if (method_exists($element, 'getTranslation')) {
            $trans = $this->getTranslation();
        } elseif (method_exists($element, 'getLabelElement')) {
            /** @var ValueTag $label */
            $label = $this->getLabelElement();
            $trans = $label->getTranslation();
        }
        if ($trans) {
            $trans->setNode($fref);
        }
    }
}