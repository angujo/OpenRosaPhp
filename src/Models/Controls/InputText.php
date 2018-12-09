<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 6:34 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Models\ControlElement;

class InputText extends ControlElement
{
    use TraitString;

    protected function __construct($name)
    {
        parent::__construct(Elmt::INPUT, $name);
        $this->setType('string');
    }

    public static function text($name)
    {
        return new self($name);
    }

    /**
     * @param $name
     * @return $this
     */
    public static function multiline($name)
    {
        return (new self($name))->setAppearance('multiline');
    }

    /**
     * @param null|int $rows
     * @return $this
     */
    public function setRows($rows = null)
    {
        if (!$rows || !is_numeric($rows)) return $this;
        return $this->setAttribute('rows', (int)$rows);
    }
}