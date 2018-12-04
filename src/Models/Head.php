<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:55 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Head\Model;
use Angujo\OpenRosaPhp\Models\Head\PrimaryInstance;


/**
 * Class Head
 * @package Angujo\OpenRosaPhp\Models
 *
 * @method $this setId(string $id);
 * @method $this rootElement(string $tag_name);
 * @method $this setVersion(string $version);
 * @method $this setElements();
 * @method $this setTranslations();
 * @method $this setItext();
 * @method $this setBinds();
 * @method PrimaryInstance getPrimaryInstance();
 * @method $this setElement(string $name, string | null $default = null);
 */
class Head extends Tag
{
    /** @var Tag|Model */
    private $model;
    /** @var Head Only one of me */
    private static $me;

    protected function __construct($title)
    {
        parent::__construct(Elmt::HEAD, null);
        $this->addNSUniqueTag('h', 'title', $title);
        $this->setNamespace('h');
        $this->model = $this->setUniqueTag(Model::create());
    }

    public static function create($title)
    {
        return self::$me = self::$me ? self::$me->title($title) : new self($title);
    }

    public static function set($title)
    {
        return self::create($title);
    }

    public function setTitle($title)
    {
        return $this->title($title);
    }

    public function title($title)
    {
        $this->addNSUniqueTag('h', 'title', $title);
        return $this;
    }

    /**
     * @return Tag|Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $method
     * @param $args
     * @return $this
     * @throws \BadMethodCallException
     */
    public function __call($method, $args)
    {
        try {
            \call_user_func_array([$this->model, $method], $args);
            return $this;
        } catch (\BadMethodCallException $exception) {
            throw new \BadMethodCallException('Invalid method "' . $method . '" called!');
        }
    }
}