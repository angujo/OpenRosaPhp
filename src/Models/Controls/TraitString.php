<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 11:26 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;

use Angujo\OpenRosaPhp\Libraries\Constraint;

/**
 * Trait TraitString
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 * @property Constraint $constraint
 */
trait TraitString
{
    public function lengthRange($min, $max, $message = 'Input character length should be within the given range!')
    {
        $this->_init();
        $min = (int)$min;
        $max = (int)$max;
        $this->constraint->setConstraint("(regex(., \"^.{{$min},{$max}}$\"))");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function minLength($min, $message = 'Input is below recommended length of characters!')
    {
        $this->_init();
        $min = (int)$min;
        $max = '';
        $this->constraint->setConstraint("(regex(., \"^.{{$min},{$max}}$\"))");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function maxLength($max, $message = 'Input length has been exceeded!')
    {
        $this->_init();
        $min = '';
        $max = (int)$max;
        $this->constraint->setConstraint("(regex(., \"^.{{$min},{$max}}$\"))");
        $this->constraint->setMessage($message);
        return $this;
    }
}