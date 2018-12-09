<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 8:19 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Utils\Helper;

trait TraitDatetime
{

    public function between($min, $max, $inclusive = false, $message = 'Should fall within the given date ranges!')
    {
        $this->_init();
        $eq = $inclusive ? '=' : '';
        $this->vldString($max);
        $this->vldString($min);
        $this->constraint->setConstraint("((. >$eq '$min') and (. <$eq '$max'))");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function greaterThan($min, $inclusive = false, $message = 'Should be greater than set date!')
    {
        $this->_init();
        $this->vldString($min);
        $eq = $inclusive ? '=' : '';
        $this->constraint->setConstraint("(. >$eq '$min')");
        $this->constraint->setMessage($message);
        return $this;
    }

    public function lessThan($max, $inclusive = false, $message = 'Should be less than set datetime!')
    {
        $this->_init();
        $this->vldString($max);
        $eq = $inclusive ? '=' : '';
        $this->constraint->setConstraint("(. <$eq '$max')");
        $this->constraint->setMessage($message);
        return $this;
    }

    private function vldString($dtString)
    {
        switch (strtolower($this->type)) {
            case 'datetime':
                $valid = Helper::validDateTime($dtString);
                break;
            case 'date':
                $valid = Helper::validDate($dtString);
                break;
            case 'time':
                $valid = Helper::validTime($dtString);
                break;
        }
        if (!$valid) throw new \RuntimeException("$dtString is an invalid datetime format!");
    }
}