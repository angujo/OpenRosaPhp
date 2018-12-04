<?php

namespace Angujo\OpenRosaPhp;

use Angujo\OpenRosaPhp\Forms\XForm;
use Angujo\OpenRosaPhp\Forms\XFormGroup;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Libraries\Ns;

/**
 *
 *
 * @authors Your Name (you@example.org)
 * @date    2018-12-04 17:20:32
 * @version 1.0.0
 */

class FormList extends Tag
{

    private static $me;

    public function __construct()
    {
        parent::__construct(Elmt::XFORMS, null);
    }

    public function create()
    {
        return self::$me = self::$me ?: new self();
    }

    /**
     * @return XForm
     */
    public function addForm($id, $name)
    {
        return $this->identifiedTag(XForm::create($id, $name), $id);
    }

    public function addGroup($id, $name)
    {
        return $this->identifiedTag(XFormGroup::create($id, $name), $id);
    }

    /**
     * @param \XMLWriter|null $xmlwriter
     * @return string|\XMLWriter
     */
    public function XMLify($xmlwriter = null)
    {
        /** @var \XMLWriter $writer */
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0','UTF-8');
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
