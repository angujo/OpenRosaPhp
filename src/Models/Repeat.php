<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\OverlayInterface;
use Angujo\OpenRosaPhp\Support\PassessNodeset;

/**
 * Class Repeat
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Repeat extends OverlayInterface
{
    use PassessNodeset;
    protected $overlay;

    public function __construct($name = null)
    {
        parent::__construct('group');
        $this->overlay = new OverlayInterface('repeat');
        $this->overlay->addElement($this);
        $this->overlay->setRef($name);
        $this->addAttribute('appearance', 'field-list');
    }

    public function setMaxRepeats($count)
    {
        $this->overlay->addAttribute('count', (int)$count);
        $this->overlay->getAttribute('count')->setNamespace('jr');
        return $this;
    }

    public function getOverlay()
    {
        return $this->overlay;
    }
}