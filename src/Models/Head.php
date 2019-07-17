<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\Bind;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\ValueTag;

/**
 * Class Head
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Head extends XMLTag
{
    private $_model;
    private $_pinstance;
    private $_data_name;
    private $_binds = [];

    public function __construct($data_name, $title)
    {
        parent::__construct('head');
        $this->tag_space = 'h';
        $this->setTitle($title);
        $this->_data_name = $data_name;
    }

    /**
     * @return ValueTag|XMLTag
     * @throws \Angujo\OpenRosaPhp\Core\OException
     */
    private function titleElement()
    {
        if (!$this->hasElement('h:title')) {
            $this->addElementUnq($h = (new ValueTag('title', null))->setTagspace('h'), 'h:title');
        }
        return $this->getElement('h:title');
    }

    public function setTitle($title)
    {
        $this->titleElement()->setContent((string)$title);
        return $this;
    }

    public function getModel()
    {
        if ($this->_model) {
            return $this->_model;
        }
        return $this->_model = new XMLTag('model');
    }

    public function primaryInstance()
    {
        if ($this->_pinstance) {
            return $this->_pinstance;
        }
        $instance         = new XMLTag('instance');
        $this->_pinstance = new XMLTag($this->_data_name);
        $instance->addElementUnq($this->_pinstance);
        $this->getModel()->addElement($instance);
        return $this->_pinstance;
    }

    public function addBind(Bind $bind)
    {
        $this->_binds[] = $bind;
        return $this;
    }
}