<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2019-10-06
 * Time: 4:42 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;

class Geopoint extends ControlElement
{
    public function __construct($name) { parent::__construct('geopoint', $name); }

    public static function MapDisplay($name)
    {
        $me = new self($name);
        $me->setType('maps');
        return $me;
    }

    public static function MapPlacement($name)
    {
        $me = new self($name);
        $me->setType('placement-map');
        return $me;
    }
}