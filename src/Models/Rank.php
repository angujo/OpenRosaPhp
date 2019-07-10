<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Support\CanBeItemised;

class Rank extends ControlElement
{
    use CanBeItemised;

    public function __construct(){ parent::__construct('odkrank'); }
}