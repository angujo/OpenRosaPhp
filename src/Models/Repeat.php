<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Support\CanBeNoded;

/**
 * Class Repeat
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Repeat extends InterfaceElement
{
    use CanBeNoded;
    protected $overlay;

    public function __construct($name = null)
    {
        parent::__construct('repeat');
        $this->overlay = new Group();
        $this->overlay->addElement($this);
        $this->overlay->setRef($name);
    }

    public function setMaxRepeats($count)
    {
        $this->addAttribute('count', (int)$count);
        $this->getAttribute('count')->setNamespace('jr');
        return $this;
    }
}