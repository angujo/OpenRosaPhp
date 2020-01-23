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

    public static function RadioButtons($name)
    {
        $me = new self($name);
        return $me;
    }

    public static function Dropdown($name)
    {
        $me = new self($name);
        $me->setAppearance('minimal');
        return $me;
    }

    public static function RadioButtonsHorizontal($name)
    {
        $me = new self($name);
        $me->setAppearance('horizontal');
        return $me;
    }

    public static function Autocomplete($name)
    {
        $me = new self($name);
        $me->setAppearance('autocomplete');
        return $me;
    }

    public static function Likert($name)
    {
        $me = new self($name);
        $me->setAppearance('likert');
        return $me;
    }
}