<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;

/**
 * Class Repeat
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Repeat extends InterfaceElement
{
    protected $overlay;

    public function __construct($name = null)
    {
        parent::__construct('repeat');
        $this->name    = $name;
        $this->overlay = new Group();
    }

    public function setMaxRepeats($count)
    {
        $this->addAttribute('count', (int)$count);
        $this->getAttribute('count')->setNamespace('jr');
        return $this;
    }
}