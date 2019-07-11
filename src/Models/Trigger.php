<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;

class Trigger extends ControlElement
{
    public function __construct($name){ parent::__construct('trigger', $name); }
}