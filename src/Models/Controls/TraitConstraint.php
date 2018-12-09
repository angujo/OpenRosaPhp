<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 8:33 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Constraint;
use Angujo\OpenRosaPhp\Models\Elements\Bind;


/**
 * Trait TraitConstraint
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 */
trait TraitConstraint
{
    /** @var Constraint */
    protected $constraint;

    protected function _init()
    {
        $this->constraint = $this->constraint ?: new Constraint();
        if (property_exists($this, 'bind') && is_a($this->bind, Bind::class) && !$this->bind->getConstraint()) {
            $this->bind->setConstraint($this->constraint);
        }
    }

    public function required($message = 'This field is required!')
    {
        if (!$this->bind) return $this;
        $this->bind->required(true)->requiredMsg($message);
        return $this;
    }

    public function readOnly()
    {
        if (!$this->bind) return $this;
        $this->bind->readonly();
        return $this;
    }
}