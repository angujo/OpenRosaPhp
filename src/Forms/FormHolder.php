<?php

namespace Angujo\OpenRosaPhp\Forms;

use Angujo\OpenRosaPhp\Libraries\Tag;

/**
 *
 *
 * @authors Your Name (you@example.org)
 * @date    2018-12-04 16:06:38
 * @version 1.0.0
 */
class FormHolder extends Tag
{

    protected $id;
    protected $_name;

    protected function __construct($element, $id)
    {
        parent::__construct($element, null);
        $this->id = $id;
    }

    public function setFormName($name)
    {
        $this->_name = $name;
        $this->addUniqueTag('name', $name);
        return $this;
    }

    public function setDescriptionUrl($url)
    {
        $this->addUniqueTag('descriptionUrl', $url);
        return $this;
    }

    public function setDescriptionText($text)
    {
        $this->addUniqueTag('descriptionText', $text);
        return $this;
    }

    public function asXML()
    {
        return $this->XMLify();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFormName()
    {
        return $this->_name;
    }
}