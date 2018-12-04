<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:26 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Elements;

class PrimaryInstance extends InstanceAbstract
{
    /** @var PrimaryInstance|null */
    private static $me;
    /** @var Meta */
    private $meta;

    protected function __construct($id = null, $root = null)
    {
        parent::__construct();
        $this->setRootTag($root);
        if ($id) $this->getRootTag()->setAttribute('id', $id);
        $this->meta = $this->getRootTag()->setUniqueTag(Meta::create($this->rootTag));
    }

    public static function create()
    {
        return self::$me = self::$me ?:new self();
    }

    public function setId($id)
    {
        $this->getRootTag()->setAttribute('id', $id);
        return $this;
    }

    public function setElements()
    {
        self::$me->getRootTag()->appendTags(Elements::asTags($this->getRootTag()->getName()));
        return $this;
    }

    public static function setElement($name, $default = null)
    {
        if (!self::$me) return null;
        return self::$me->getRootTag()->addUniqueTag($name, $default);
    }

    public function rootElement($tag)
    {
        $this->getRootTag()->changeName($tag);
        $this->getMeta()->changeRoot($tag);
        return $this;
    }

    /**
     * @return \Angujo\OpenRosaPhp\Libraries\Tag|Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }
}