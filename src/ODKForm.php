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
use Angujo\OpenRosaPhp\Models\BodyElement;
use Angujo\OpenRosaPhp\Models\Controls\InputDateTime;
use Angujo\OpenRosaPhp\Models\Controls\InputNumber;
use Angujo\OpenRosaPhp\Models\Controls\InputText;
use Angujo\OpenRosaPhp\Models\Controls\Select;
use Angujo\OpenRosaPhp\Models\Controls\Select1;
use Angujo\OpenRosaPhp\Models\Controls\Upload;
use Angujo\OpenRosaPhp\Models\Group;
use Angujo\OpenRosaPhp\Models\Head;
use Angujo\OpenRosaPhp\Models\Repeat;

/**
 * Class ODKForm
 * @package Angujo\OpenRosaPhp
 *
 * @method $this setTitle(string $title)
 * @method $this setVersion(string $version)
 * @method $this setId(string $id)
 * @method Group group(string $name)
 * @method Repeat repeat(string $name)
 * @method InputText inputText(string $name)
 * @method InputNumber inputDecimal(string $name)
 * @method InputNumber inputInteger(string $name)
 * @method InputText inputMultiline(string $name)
 * @method Upload uploadImage(string $name)
 * @method Upload uploadVideo(string $name)
 * @method Upload uploadAudio(string $name)
 * @method Upload uploadFile(string $name)
 * @method Upload barcode(string $name)
 * @method Upload uploadCustom(string $name, array $mimes)
 * @method InputDateTime dateYearMonth(string $name)
 * @method InputDateTime dateYear(string $name)
 * @method InputDateTime dateFull(string $name)
 * @method InputDateTime time(string $name)
 * @method Select1 selectOne(string $name)
 * @method Select1 selectOneLikert(string $name)
 * @method Select1 selectOneQuick(string $name)
 * @method Select selectMultiple(string $name)
 * @method BodyElement addElement(BodyElement $element)
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
        if (!self::$me) {
            self::$me = new self();
        }

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

    public function submission($url,$encryption_key=null)
    {
        return $this->head->submission($url,$encryption_key);
    }

    public function XMLify($w = null)
    {
        return $w;
    }

    /**
     * @return string|\XMLWriter
     */
    public function asXML()
    {
        $this->generate();
        return parent::XMLify();
    }

    public function __call($method, $args)
    {
        if (method_exists($this->body, $method)) {
            return \call_user_func_array([$this->body, $method], $args);
        }
        try {
            \call_user_func_array([$this->head, $method], $args);
            return $this;
        } catch (\BadMethodCallException $exception) {
            throw new \BadMethodCallException($exception->getMessage());
        }
    }
}
