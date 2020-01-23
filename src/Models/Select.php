<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Support\CanBeItemised;

class Select extends ControlElement
{
    use CanBeItemised;

    public function __construct($name)
    {
        parent::__construct('select', $name);
        self::setType('select');
    }

    public static function Checkboxes($name)
    {
        $me = new self($name);
        return $me;
    }

    public static function CheckboxesHorizontal($name)
    {
        $me = new self($name);
        $me->setAppearance('horizontal');
        return $me;
    }

    public static function Dropdown($name)
    {
        $me = new self($name);
        $me->setAppearance('minimal');
        return $me;
    }

    public static function Autocomplete($name)
    {
        $me = new self($name);
        $me->setAppearance('autocomplete');
        return $me;
    }
}