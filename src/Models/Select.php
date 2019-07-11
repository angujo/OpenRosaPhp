<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Support\CanBeItemised;

class Select extends ControlElement
{
    use CanBeItemised;

    public function __construct($name){ parent::__construct('select',$name); }
}