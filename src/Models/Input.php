<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;

class Input extends ControlElement
{
    public function __construct($name){ parent::__construct('input', $name); }

    public static function Text($name)
    {
        $me = new self($name);
        $me->setType('string');
        return $me;
    }

    public static function TextArea($name)
    {
        $me = new self($name);
        $me->setType('string');
        $me->setAppearance('multiline');
        return $me;
    }

    public static function NumberInteger($name)
    {
        $me = new self($name);
        $me->setType('int');
        return $me;
    }

    public static function NumberDecimal($name)
    {
        $me = new self($name);
        $me->setType('decimal');
        return $me;
    }

    public static function BooleanType($name)
    {
        $me = new self($name);
        $me->setType('boolean');
        return $me;
    }

    public static function DateType($name)
    {
        $me = new self($name);
        $me->setType('date');
        return $me;
    }

    public static function DateMonthYear($name)
    {
        $me = new self($name);
        $me->setType('month-year');
        return $me;
    }

    public static function DateYear($name)
    {
        $me = new self($name);
        $me->setType('year');
        return $me;
    }

    public static function TimeType($name)
    {
        $me = new self($name);
        $me->setType('time');
        return $me;
    }

    public static function DateTime($name)
    {
        $me = new self($name);
        $me->setType('dateTime');
        return $me;
    }

    public static function Barcode($name)
    {
        $me = new self($name);
        $me->setType('barcode');
        return $me;
    }

    public static function Url($name)
    {
        $me = new self($name);
        $me->setType('url');
        return $me;
    }
}