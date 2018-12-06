<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 4:06 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Binds;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Itext;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Submission;


/**
 * Class Model
 * @package Angujo\OpenRosaPhp\Models\Head
 *
 * @method $this setId(string $id);
 * @method $this rootElement(string $tag_name);
 * @method $this setVersion(string $version);
 * @method $this setElements();
 * @method $this setElement(string $name, string | null $default = null);
 */
class Model extends Tag
{
    /** @var Model Only one of me */
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

    /**
     * @return Tag|PrimaryInstance
     */
    public function getPrimaryInstance()
    {
        return $this->primaryInstance;
    }

    /**
     * @return Model
     */
    public function setTranslations()
    {
        return $this->setItext();
    }

    /**
     * @return $this
     */
    public function setItext()
    {
        $this->setUniqueTag(Itext::create());
        return $this;
    }

    /**
     * @return $this
     */
    public function setBinds()
    {
        return $this->appendTags(Binds::all());
    }

    public function submission($url,$encryption=null)
    {
        return $this->setUniqueTag(Submission::post($url,$encryption));
    }

    /**
     * @param $method
     * @param $args
     * @return $this
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (method_exists($this->primaryInstance, $method)) {
            \call_user_func_array([$this->primaryInstance, $method], $args);
            return $this;
        }
        throw new \BadMethodCallException('Invalid method "' . $method . '" called!');
    }
}