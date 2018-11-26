<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 4:06 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Bind;

class Model extends Tag
{
    private static $me;
    /** @var Tag|PrimaryInstance */
    private $primaryInstance;

    public function __construct()
    {
        parent::__construct(Elmt::MODEL, null);
        $this->primaryInstance = $this->setUniqueTag(PrimaryInstance::create(uniqid('id', false), 'data'));
    }

    /**
     * @return Model
     */
    public static function create()
    {
        return self::$me = self::$me ?: new self();
    }

    public static function addBind(Tag $bind)
    {
        return self::create()->_bind($bind);
    }

    private function _bind(Tag $bind)
    {
        $this->setTag($bind);
        return $bind;
    }

    public function setId($id)
    {
        $this->primaryInstance->getRootTag()->setAttribute('id', $id);
        return $this;
    }

    public function setVersion($id)
    {
        $this->primaryInstance->getRootTag()->setNSAttribute('orx', 'version', $id);
        return $this;
    }

    public function rootElement($tag)
    {
        $this->primaryInstance->getRootTag()->changeName($tag);
        $this->primaryInstance->getMeta()->changeRoot($tag);
        return $this;
    }

    /**
     * @return Tag|PrimaryInstance
     */
    public function primaryInstance()
    {
        return $this->primaryInstance;
    }
}