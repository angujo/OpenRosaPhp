<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-08
 * Time: 4:26 PM
 */

namespace Angujo\OpenRosaPhp\Libraries;


class Constraint
{
const CONTAINS    = 'contains';
const STARTS_WITH = 'starts-with';
const END_WITH    = 'ends-with';

    /**
     * Conditions will be in array format
     * e.g. [and,contains,needle]
     * OR [and,contains,[...]]
     * @var array
     */
    protected $conditions = [];

    protected $constraint = '';
    protected $message    = '';

    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /*
     * @param $method
     * @param $args
     * @return $this
     * @throws \BadMethodCallException
     */
    /*public function __call($method, $args)
    {
        $broken = explode('_', Helper::camelCaseToUnderscore($method));
        $joiner = 'and';
        if (0 === strcasecmp($broken[0], 'or')) $joiner = array_shift($broken);
        $method_ = '_' . implode('_', $broken);
        array_unshift($args, $joiner);
        if (method_exists($this, $method_)) {
            \call_user_func_array([$this, $method_], $args);
            return $this;
        }
        throw new \BadMethodCallException("$method does not exist!");
    }*/

    public function Raw($constraint, $joiner = 'and')
    {
        if ($this->constraint) $this->constraint .= " $joiner ";
        $this->constraint .= "($constraint)";
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getConstraint(): string
    {
        return $this->constraint;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $constraint
     * @return Constraint
     */
    public function setConstraint(string $constraint): Constraint
    {
        $this->constraint = $constraint;
        Ns::collect('jr');
        return $this;
    }

    /**
     * @param string $message
     * @return Constraint
     */
    public function setMessage(string $message): Constraint
    {
        $this->message = $message;
        return $this;
    }
}