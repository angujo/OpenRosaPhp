<?php
/**
 * Hold Elements for ODK XML
 *
 * @authors bangujo (bangujo)
 * @date    2018-11-26 11:38:46
 * @version 1.0.0
 */

namespace Angujo\OpenRosaPhp\Libraries;

/**
 *
 */
class Elements
{

    /** @var Elements Only me */
    private static $me;
    /** @var Tag[] */
    private $elements = [];

    private function __construct()
    {

    }

    protected static function init()
    {
        return self::$me = self::$me ?: new self();
    }

    public static function add($name, $id, $pid, $value = null)
    {
        if ($c = self::get($id)) {
            $c->setName($name)->setValue($value);
            return $c;
        }
        $c = Element::set($name, $value);
        if ($p = self::get($pid)) {
            $p->addChild($c, $id);
        } else {
            self::init()->elements[$id] = $c;
        }
        return $c;
    }

    /**
     *
     * @return Element
     */
    public static function get($id)
    {
        return self::init()->franticSearch($id);
    }

    /**
     * @param string $id
     * @param Element $tag
     *
     * @return Element
     */
    private function franticSearch($id, $tag = null)
    {
        $list = null === $tag ? $this->elements : $tag->getChildren();
        if (array_key_exists($id, $list)) {
            return $list[$id];
        }
        foreach ($list as $id => $tag) {
            return $this->franticSearch($id, $tag);
        }
        return null;
    }

}
