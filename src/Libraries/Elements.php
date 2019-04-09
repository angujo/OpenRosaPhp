<?php
/**
 * Hold Elements for ODK XML
 *
 * @authors bangujo (bangujo)
 * @date    2018-11-26 11:38:46
 * @version 1.0.0
 */

namespace Angujo\OpenRosaPhp\Libraries;

use Adbar\Dot;

/**
 *
 */
class Elements
{

    /** @var Elements Only me */
    private static $me;
    /** @var Tag[] */
    private $elements = [];
    /** @var array */
    private static $levels = [];
    /** @var Dot */
    private $dot;

    private function __construct()
    {
        $this->dot = new Dot();
    }

    public static function create($path, $default = null)
    {
        $path = self::dotPath($path);
        if (self::init()->dot->has($path)) self::init()->dot->set($path, $default);
        else self::init()->dot->add($path, $default);
    }

    public static function has($path)
    {
        return self::init()->dot->has(self::dotPath($path));
    }

    private static function dotPath($path)
    {
        return implode('.', array_filter(explode('/', $path), 'trim'));
    }

    public static function changeName($old_path, $new_path, $default = null)
    {
        $old_path = self::dotPath($old_path);
        $new_path = self::dotPath($new_path);
        if (!$new_path) return;
        if ($old_path && self::init()->dot->has($old_path)) {
            $default = $default ?: self::init()->dot->get($old_path);
            self::init()->dot->delete($old_path);
        }
        self::create($new_path, $default);
    }

    protected static function init()
    {
        return self::$me = self::$me ?: new self();
    }

    public static function all()
    {
        return self::init()->dot->all();
    }

    /**
     * @param null|string $root
     * @return Tag[]
     */
    public static function asTags($root = null)
    {
        if (null !== $root) {
            if (!self::init()->dot->has($root) || !\is_array(self::init()->dot->get($root))) return [];
            return self::tagMe(self::init()->dot->get($root));
        }
        return self::tagMe(self::all());
    }

    /**
     * @param array $list
     * @return Tag[]
     */
    private static function tagMe(array $list)
    {
        /** @var Tag[] $tags */
        $tags = [];
        foreach ($list as $name => $value) {
            $tag = Tag::emptyTag($name);
            if (\is_array($value)) $tag->setTags(self::tagMe($value));
            else $tag->setValue($value);
            $tags[] = $tag;
        }
        return $tags;
    }

    public static function isElementSet($id)
    {
        return self::idSet($id);
    }

    private static function idSet($id, $lst = null)
    {
        if (null === $lst || !is_array($lst)) $lst = self::$levels;
        foreach ($lst as $_id => $children) {
            if (0 === strcasecmp($id, $_id) || true === self::idSet($id, $children)) return true;
        }
        return false;
    }

    private static function add($name, $id, $pid, $value = null)
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
    private static function get($id)
    {
        return self::init()->franticSearch($id);
    }

    /**
     * @param string $id
     * @param Element $tag
     *
     * @return Element
     */
    private function &franticSearch($id, $tag = null)
    {
        $list = null === $tag ? $this->elements : $tag->getChildren();
        if (array_key_exists($id, $list)) {
            return $list[$id];
        }
        foreach ($list as $id_ => $tag_) {
            return $this->franticSearch($id_, $tag_);
        }
        return null;
    }

}
