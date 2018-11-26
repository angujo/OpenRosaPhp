<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 6:44 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;

class Select1 extends OptionBased
{
    protected function __construct($name)
    {
        parent::__construct(Elmt::SELECT1, $name);
        $this->setType('select1');
    }

    public static function create($name)
    {
        return new self($name);
    }

    public static function likert($name)
    {
        return (new self($name))->setAppearance('likert');
    }

    public static function quick($name)
    {
        return (new self($name))->setAppearance('quick');
    }
}