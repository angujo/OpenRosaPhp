<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Core\OverlayInterface;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\CanBeNoded;
use Angujo\OpenRosaPhp\Support\PassessNodeset;

/**
 * Class Repeat
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Repeat extends Group
{
    use CanBeNoded;
    protected $overlayered;
    protected $root;

    public function __construct($name = null)
    {
        $this->root = new OverlayInterface('repeat');
        parent::__construct($name);
        $this->addElement($this->root);
        $this->overlayered = new OverlayInterface('group');
        $this->root->addElement($this->overlayered);
        $this->overlayered->setNodeset($this->getNodeset()); /**/
        $this->overlayered->addAttribute('appearance', 'field-list');
    }

    public function setMaxRepeats($count)
    {
        $this->root->addAttribute('count', $count);
        $this->root->getAttribute('count')->setNamespace('jr');
        return $this;
    }

    /**
     * @return OverlayInterface
     */
    public function getOverlayered()
    {
        return $this->overlayered;
    }
}