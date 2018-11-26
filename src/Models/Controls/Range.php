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

class Range extends ControlElement
{
    private $appearance = [];

    protected function __construct($name, $start = 1, $end = 100, $step = 1)
    {
        parent::__construct(Elmt::RANGE, $name);
        $this->setType('integer');
        $this->start($start)->end($end)->step($step);
    }

    public static function asSlider($name)
    {
        return new self($name);
    }

    public static function asPicker($name)
    {
        return (new self($name))->setAppearance('picker');
    }

    public static function asVerticalSlider($name)
    {
        return (new self($name))->setAppearance('vertical');
    }

    public function start($starts)
    {
        $this->addAttribute('start', $starts);
        return $this;
    }

    public function end($end)
    {
        $this->addAttribute('end', $end);
        return $this;
    }

    public function step($step)
    {
        $this->addAttribute('step', $step);
        return $this;
    }

    public function ticks($t = true)
    {
        if (!$t) $this->appearance[] = 'no-ticks';
        elseif (false !== ($k = array_search('no-ticks', $this->appearance, false))) unset($this->appearance[$k]);
        $this->appearance = array_unique($this->appearance);
        $this->addAttribute('appearance', implode(' ', $this->appearance));
        return $this;
    }

    protected function setAppearance($appears)
    {
        $this->appearance[] = $appears;
        return parent::setAppearance($appears);
    }
}