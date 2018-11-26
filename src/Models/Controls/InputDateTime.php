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

class InputDateTime extends ControlElement
{
    use TraitMinMax;
    protected const YM = 'month-year';
    protected const Y  = 'year';

    protected function __construct($name)
    {
        parent::__construct(Elmt::INPUT, $name);
        $this->setType('date');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function yearMonth($name)
    {
        return (new self($name))->setAppearance(self::YM);
    }

    /**
     * @param string $name
     * @return InputDateTime
     */
    public static function fullDate($name)
    {
        return new self($name);
    }

    /**
     * @param string $name
     * @return InputDateTime
     */
    public static function fullDateTime($name)
    {
        return (new self($name))->setType('dateTime');
    }

    /**
     * @param string $name
     * @return InputDateTime
     */
    public static function time($name)
    {
        return (new self($name))->setType('time');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function year($name)
    {
        return (new self($name))->setAppearance(self::Y);
    }

}