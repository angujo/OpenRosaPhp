<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\ValueTag;

/**
 * Class Head
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Head extends XMLTag
{
    public function __construct($title)
    {
        parent::__construct('head');
        $this->tag_space = 'h';
        $this->setTitle($title);
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
}