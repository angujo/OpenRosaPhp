<?php

namespace Angujo\OpenRosaPhp\Forms;

use Angujo\OpenRosaPhp\Libraries\Elmt;


/**
 * 
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-12-04 17:12:26
 * @version 1.0.0
 */

class XFormGroup extends FormHolder {
    
    protected function __construct($id, $name)
    {
        parent::__construct(Elmt::XFORMGROUP,$id);
        $this->setID($id)->setFormName($name);
    }

    public static function create($id, $name)
    {
        return new self($id, $name);
    }

    public function setID($id)
    {
        $this->addUniqueTag('groupID', $id);
        return $this;
    }

    public function setListUrl($url)
    {
        $this->addUniqueTag('listUrl', $url);
        return $this;
    }
}