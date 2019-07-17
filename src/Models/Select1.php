<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Support\CanBeItemised;

class Select1 extends ControlElement
{
    use CanBeItemised;

    public function __construct($name)
    {
        parent::__construct('select1', $name);
        self::setType('select1');
    }
}