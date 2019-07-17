<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\Bind;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\ValueTag;
use Angujo\OpenRosaPhp\Utils\Helper;

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
    private $_variables = [];

    public function __construct(&$data_name, &$title)
    {
        parent::__construct('head');
        $this->tag_space = 'h';
        $this->setTitle($title);
        $this->_data_name =& $data_name;
        $this->primaryInstance();
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

    public function setVariable($index, $value, $def_value = null)
    {
        $this->_variables[$index] = [$value, $def_value];
        return $this;
    }

    public function setTitle(&$title)
    {
        $this->titleElement()->setContent((string)$title);
        return $this;
    }

    public function getModel()
    {
        if ($this->_model) {
            return $this->_model;
        }
        $this->_model = new HeadModel('model');
        $this->addElementUnq($this->_model);
        return $this->_model;
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

    public function setPrimaryInstance()
    {
        $arr = [];
        foreach ($this->_variables as $ns) {
            Helper::array_dot($arr, $ns[0], $ns[1], '/');
        }
        $arr=array_shift($arr);
        $this->loopInstance($this->primaryInstance(), $arr);
    }

    private function loopInstance(XMLTag $parent,$arr)
    {
        foreach ($arr as $index => $item) {
            if (!preg_match('/^[a-z][\w-]+$/i', $index))continue;
            $elmt=new XMLTag($index);
            $parent->addElementUnq($elmt);
            if (!is_array($item)) $elmt->setContent($item);
            else $this->loopInstance($elmt, $item);
        }
    }
}