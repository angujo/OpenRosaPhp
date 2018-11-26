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

class Select extends OptionBased
{
    protected function __construct($name)
    {
        parent::__construct(Elmt::SELECT, $name);
        $this->setType('select');
    }

    public static function create($name)
    {
        return new self($name);
    }
}