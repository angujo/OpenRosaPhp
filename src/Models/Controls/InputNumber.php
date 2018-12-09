<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 6:44 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Models\ControlElement;

class InputNumber extends ControlElement
{
    use TraitNumber;

    /**
     * @param $name
     * @return $this
     */
    public static function decimal($name)
    {
        return (new self(Elmt::INPUT, $name))->setType('decimal');
    }

    /**
     * @param $name
     * @return $this
     */
    public static function integer($name)
    {
        return (new self(Elmt::INPUT, $name))->setType('integer');
    }
}