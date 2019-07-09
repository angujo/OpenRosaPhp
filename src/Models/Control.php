<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Core\OException;

/**
 * Class Control
 *
 * @package Angujo\OpenRosaPhp\Models
 *
 * @method static ControlElement input()
 * @method static ControlElement select1()
 * @method static ControlElement select()
 * @method static ControlElement upload()
 * @method static ControlElement trigger()
 * @method static ControlElement range()
 * @method static ControlElement odkRank()
 */
class Control extends ControlElement
{

    /**
     * @param $name
     * @param $args
     *
     * @return ControlElement
     * @throws OException
     */
    public static function __callStatic($name, $args)
    {
        return new self($name);
    }
}