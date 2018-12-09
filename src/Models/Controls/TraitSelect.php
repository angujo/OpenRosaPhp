<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 11:40 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;

use Angujo\OpenRosaPhp\Libraries\Constraint;

/**
 * Trait TraitSelect
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 * @property Constraint $constraint
 */
trait TraitSelect
{

    public function selectionRange($min, $max, $message = 'Selections should be within the required number of selections!')
    {
        $this->_init();
        $min = (int)$min;
        $max = (int)$max;
        $this->constraint->setConstraint("((count-selected(.) >= '$min') and (count-selected(.) <= '$max'))");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function minSelection($min, $message = 'You must at least select minimum required number of selections!')
    {
        $min = (int)$min;
        $this->constraint->setConstraint("(count-selected(.) >= '$min')");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function maxSelection($max, $message = 'You can only have maximum amount of required selections!')
    {
        $max = (int)$max;
        $this->constraint->setConstraint("(count-selected(.) <= '$max')");
        $this->constraint->setMessage($message);
        return $this;
    }
}