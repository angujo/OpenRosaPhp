<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 7:05 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class Xform extends Tag
{
    private static $me;
    /** @var Tag|Head */
    private $head;
    /** @var Tag|Body */
    private $body;

    protected function __construct()
    {
        parent::__construct(Elmt::HTML, null);
        $this->head = $this->setUniqueTag(Head::set('Untitled Form'));
        $this->body = $this->setUniqueTag(Body::create());
    }

    /**
     * @return Xform
     */
    public static function init()
    {
        if (!self::$me) {
            self::$me = new self(Elmt::HTML, null);
            self::$me->setNamespace('h');
        }
        return self::$me;
    }

    /**
     * @param $title
     * @return Tag|Head
     */
    public function title($title)
    {
        return $this->head->title($title);
    }

    public function version($title)
    {
        return $this->head->setVersion($title);
    }

    public function id($title)
    {
        return $this->head->setId($title);
    }

    public function dataElement($element)
    {
        $this->head->rootElement($element);
        $this->body->setRootElement($element);
        return $this;
    }

    /**
     * @return Tag|Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return Tag|Head\Meta
     */
    public function getMeta()
    {
        return $this->head->getModel()->getPrimaryInstance()->getMeta();
    }

    public function generate()
    {
        $this->head->setElements();
        $this->head->setItext();
        $this->head->setBinds();
        //$this->body->elements($this->head->getModel()->primaryInstance()->getRootTag());
        //$this->body->setElements($this->head->getModel()->getPrimaryInstance()->getRootTag());
        //$this->head->getModel()->setUniqueTag(Itext::create());
        //$this->head->getModel()->appendTags(Binds::all());

    }
}