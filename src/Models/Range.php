<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;

class Range extends ControlElement
{
    public function __construct($name, $starts, $ends, $step)
    {
        parent::__construct('range', $name);
        $this->setStart($starts)->setEnd($ends)->setStep($step);
    }

    public static function create($name, $starts, $ends, $step)
    {
        return new self($name, $starts, $ends, $step);
    }

    public function setStart($start)
    {
        $this->getAttribute('start') ? $this->getAttribute('start')->setValue($start) : $this->addAttribute('start', $start);
        return $this;
    }

    public function getStart()
    {
        return $this->getAttribute('start') ? $this->getAttribute('start')->getValue() : $this->addAttribute('start')->getStart();
    }

    public function setEnd($ends)
    {
        $this->getAttribute('ends') ? $this->getAttribute('ends')->setValue($ends) : $this->addAttribute('ends', $ends);
        return $this;
    }

    public function getEnd()
    {
        return $this->getAttribute('ends') ? $this->getAttribute('ends')->getValue() : $this->addAttribute('ends')->getStart();
    }

    public function setStep($step)
    {
        $this->getAttribute('step') ? $this->getAttribute('step')->setValue($step) : $this->addAttribute('step', $step);
        return $this;
    }

    public function getStep()
    {
        return $this->getAttribute('step') ? $this->getAttribute('step')->getValue() : $this->addAttribute('step')->getStep();
    }
}