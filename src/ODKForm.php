<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-04
 * Time: 7:27 AM
 */

namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Body;
use Angujo\OpenRosaPhp\Models\Head;

/**
 * Class ODKForm
 * @package Angujo\OpenRosaPhp
 *
 * @method $this setTitle(string $title)
 * @method $this setVersion(string $version)
 * @method $this setId(string $id)
 */
class ODKForm extends Tag
{
    /** @var Tag|Head */
    private $head;
    /** @var Tag|Body */
    private $body;
    /** @var ODKForm */
    private static $me;

    public function __construct($title = 'Untitled Form')
    {
        parent::__construct(Elmt::HTML, null);
        $this->setNamespace('h');
        $this->head = $this->setUniqueTag(Head::set($title));
        $this->body = $this->setUniqueTag(Body::create());
    }

    /**
     * @param $title
     * @return ODKForm
     */
    public static function create($title)
    {
        if (!self::$me) self::$me = new self();
        return self::$me->setTitle($title);
    }

    /**
     * @return Tag|Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return Tag|Head
     */
    public function getHeader()
    {
        return $this->head;
    }

    /**
     * @param $element
     * @return $this
     */
    public function dataElement($element)
    {
        $this->head->rootElement($element);
        $this->body->setRootElement($element);
        return $this;
    }

    private function generate()
    {
        $this->head->setElements();
        $this->head->setItext();
        $this->head->setBinds();
    }

    /**
     * @return string|\XMLWriter
     */
    public function asXML()
    {
        $this->generate();
        return $this->XMLify();
    }

    public function __call($method, $args)
    {
        try {
            \call_user_func_array([$this->head, $method], $args);
            return $this;
        } catch (\BadMethodCallException $exception) {

            try {
                \call_user_func_array([$this->body, $method], $args);
                return $this;
            } catch (\BadMethodCallException $exception) {
                throw new \BadMethodCallException($exception->getMessage());
            }
        }
    }
}