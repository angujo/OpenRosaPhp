<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 6:44 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;

class Select extends OptionBased
{
    use TraitSelect;

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