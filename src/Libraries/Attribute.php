<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:07 PM
 */

namespace Angujo\OpenRosaPhp\Libraries;


class Attribute
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $namespace;
    /** @var string */
    protected $value;

    private function __construct($name, $value, $ns = null)
    {
        $this->setName($name)->setValue($value)->setNamespace($ns);
    }

    /**
     * @param string $namespace
     * @param string $name
     * @param string $value
     * @return Attribute
     */
    public static function namespaced($namespace, $name, $value)
    {
        return new self($name, $value, $namespace);
    }

    /**
     * @param string $name
     * @param string $value
     * @return Attribute
     */
    public static function create($name, $value)
    {
        return new self($name, $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return Attribute
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        Ns::collect($this->namespace);
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Attribute
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}