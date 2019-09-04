<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\NS;
use Angujo\OpenRosaPhp\Utils\Helper;

class Attribute
{
    private $name;
    private $value;
    private $namespace;
    private static $namespaces = [];

    /**
     * Attribute constructor.
     *
     * @param $name
     *
     * @throws OException
     */
    public function __construct($name)
    {
        Helper::validateTagName($name);
        $this->name = $name;
    }

    /**
     * @param $name
     *
     * @return Attribute
     * @throws OException
     */
    public static function create($name, $value = null)
    {
        return (new self($name))->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return Attribute
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     *
     * @return Attribute
     */
    public function setNamespace($namespace)
    {
        $this->namespace              = $namespace;
        self::$namespaces[$namespace] = $this->getNamespaceUrl();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNamespaceUrl()
    {
        return NS::url($this->namespace);
    }

    public function getFullName()
    {
        return ($this->namespace ? $this->namespace.':' : '').$this->name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public static function getNamespaces(): array
    {
        return self::$namespaces;
    }

    public static function addElementNamespace($name)
    {
        if (!($url = NS::url($name))) {
            return;
        }
        self::$namespaces[$name] = $url;
    }
}