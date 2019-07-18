<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Core\OverlayInterface;
use Angujo\OpenRosaPhp\Support\CanBeNoded;
use Angujo\OpenRosaPhp\Support\PassessNodeset;

/**
 * Class Repeat
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Repeat extends InterfaceElement
{
    use CanBeNoded;
    protected $overlayered;

    public function __construct($name = null)
    {
        parent::__construct('repeat');
        $this->setRef($name);
        $this->overlayered = new OverlayInterface('group');
        $this->addElement($this->overlayered);
        $this->overlayered->setNodeset($this->getNodeset()); /**/
        $this->overlayered->addAttribute('appearance', 'field-list');
    }

    public function setMaxRepeats($count)
    {
        $this->addAttribute('count', (int)$count);
        $this->getAttribute('count')->setNamespace('jr');
        return $this;
    }

    public function getOverlayered()
    {
        return $this->overlayered;
    }
}