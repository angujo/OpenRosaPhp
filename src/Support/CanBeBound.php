<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\Bind;
use Angujo\OpenRosaPhp\Core\OException;

/**
 * Trait CanBeBound
 *
 * @package Angujo\OpenRosaPhp\Support
 *
 * @method static setRequired($req = true)
 * @method static setReadOnly($read = true)
 * @method static setType($value)
 * @method static minValue($value)
 * @method static maxValue($value)
 * @method static getRelevant()
 * @method static setRelevant($revelant)
 * @method static setConstraint($constraint)
 * @method static getConstraint()
 * @method static setConstraintMessage($msg)
 * @method static setRequiredMessage($msg)
 * @method static setCalculation($calculation)
 * @method static getCalculation()
 */
trait CanBeBound
{
    private $_bind;

    /**
     * @return Bind
     * @throws OException
     */
    public function getBind()
    {
        return $this->_bind = $this->_bind ?: new Bind();
    }

    public function __call($name, $args)
    {
        if (method_exists($this->getBind(), $name)) {
            return call_user_func_array([$this->getBind(), $name], $args);
        }
        return null;
    }
}