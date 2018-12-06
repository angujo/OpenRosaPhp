<?php

namespace Angujo\OpenRosaPhp;

use Angujo\OpenRosaPhp\Forms\XForm;
use Angujo\OpenRosaPhp\Forms\XFormGroup;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Ns;
use Angujo\OpenRosaPhp\Libraries\Tag;

/**
 * Class FormList
 * @package Angujo\OpenRosaPhp
 */
class FormList extends Tag
{

    /** @var FormList */
    private static $me;

    public function __construct()
    {
        parent::__construct(Elmt::XFORMS, null);
    }

    /**
     * @return FormList
     */
    public function create()
    {
        return self::$me = self::$me ?: new self();
    }

    /**
     * @param string|XForm $idForm
     * @param string|null $name
     * @return Tag|XForm
     */
    public function addForm($idForm, $name = null)
    {
        if (\is_object($idForm)) return $this->setForm($idForm);
        return $this->identifiedTag(XForm::create($idForm, $name), $idForm);
    }

    /**
     * @param XForm $XForm
     * @return Tag|XForm
     */
    public function setForm(XForm $XForm)
    {
        return $this->identifiedTag($XForm, $XForm->getId());
    }

    /**
     * @param XFormGroup $XFormXFormGroup
     * @return Tag|XFormGroup
     */
    public function setGroup(XFormGroup $XFormXFormGroup)
    {
        return $this->identifiedTag($XFormXFormGroup, $XFormXFormGroup->getId());
    }

    /**
     * @param string|XFormGroup $idGroup
     * @param string $name
     * @return Tag|XFormGroup
     */
    public function addGroup($idGroup, $name = null)
    {
        if (\is_object($idGroup)) return $this->setGroup($idGroup);
        return $this->identifiedTag(XFormGroup::create($idGroup, $name), $idGroup);
    }

    /**
     * @return string
     */
    public function XMLify($w = null)
    {
        return $w;
    }

    public function asXML()
    {
        /** @var \XMLWriter $writer */
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement($this->getName());

        $writer->writeAttribute('xmlns', Ns::XFORMSLIST);
        foreach ($this->tags as $tag) {
            $tag->XMLify($writer);
        }
        $writer->endElement();
        $writer->endDocument();
        return $writer->outputMemory();
    }
}
