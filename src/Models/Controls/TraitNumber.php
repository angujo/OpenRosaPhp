<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 8:19 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;



trait TraitNumber
{

    public function range($min, $max, $inclusive = false, $message = 'Should fall within the given value ranges!')
    {
        $this->_init();
        $min = (float)$min;
        $max = (float)$max;
        $eq = $inclusive ? '=' : '';
        $this->constraint->setConstraint("((. >$eq '$min') and (. <$eq '$max'))");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function unsigned($message = 'Only unsigned values allowed!')
    {
        $this->_init();
        return $this->greaterThan(0, true, $message);
    }

    public function greaterThan($min, $inclusive = false, $message = 'Should be greater than set value!')
    {
        $this->_init();
        $min = (float)$min;
        $eq = $inclusive ? '=' : '';
        $this->constraint->setConstraint("(. >$eq '$min')");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function lessThan($max, $inclusive = false, $message = 'Should be less than set amount!')
    {
        $this->_init();
        $max = (float)$max;
        $eq = $inclusive ? '=' : '';
        $this->constraint->setConstraint("(. <$eq '$max')");
        $this->constraint->setMessage($message);
        return $this;
    }
}