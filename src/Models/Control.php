<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Core\OException;

/**
 * Class Control
 *
 * @package Angujo\OpenRosaPhp\Models
 *
 * @method static ControlElement input($name, $type = 'string')
 * @method static ControlElement select1($name)
 * @method static ControlElement select($name)
 * @method static ControlElement upload($name)
 * @method static ControlElement trigger($name)
 * @method static ControlElement range($name)
 * @method static ControlElement odkRank($name)
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
        if (!($nm = array_shift($args))) {
            throw new OException('Missing name of the element!');
        }
        if (0 === strcasecmp('input', $nm)) {
            if (!($tp = array_shift($args))) {
                throw new OException('Input should have data type set!');
            }
        }
        /** @var ControlElement $cntr */
        $cntr = new self($name, $nm);
        if (!empty($tp)) {
            $cntr->setType($tp);
        }
        return $cntr;
    }
}