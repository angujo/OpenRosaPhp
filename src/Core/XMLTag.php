<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\NS;
use Angujo\OpenRosaPhp\Utils\Helper;

class XMLTag
{
    private $tag;
    protected $attributes = [];
    protected $elements = [];
    protected $tag_space;

    /**
     * XMLTag constructor.
     *
     * @param $tag
     *
     * @throws OException
     */
    public function __construct($tag)
    {
        Helper::validateTagName($tag);
        $this->tag = $tag;
    }

    /**
     * @param $name
     *
     * @return XMLTag
     * @throws OException
     */
    protected static function create($name)
    {
        return new self($name);
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return XMLTag
     */
    protected function setAttributes(array $attributes): XMLTag
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param Attribute|string $attr
     *
     * @return XMLTag
     * @throws OException
     */
    protected function addAttribute($attr)
    {
        if (is_object($attr) && is_a($attr, Attribute::class)) {
            $this->attributes[$attr->getFullName()] = $attr;
        } else {
            return $this->addAttribute(Attribute::create($attr));
        }
        return $this;
    }

    protected function getAttribute($name)
    {
        return $this->attributes[$name] ?? null;
    }

    protected function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return XMLTag[]
     */
    protected function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @param string|XMLTag $elmt
     *
     * @return $this|XMLTag
     * @throws OException
     */
    protected function addElement($elmt)
    {
        $this->setElement($elmt);
        return $this;
    }

    /**
     * @param $elmt
     *
     * @return $this
     * @throws OException
     */
    protected function addElementUnq($elmt)
    {
        $this->setElement($elmt, true);
        return $this;
    }

    /**
     * @param string|int $name
     *
     * @return XMLTag|null
     */
    protected function getElement($name)
    {
        return $this->elements[$name] ?? null;
    }

    protected function hasElement($name)
    {
        return isset($this->elements[$name]);
    }

    /**
     * @param XMLTag $elmt
     * @param bool   $unique
     *
     * @throws OException
     */
    private function setElement(XMLTag $elmt, $unique = false)
    {
        if (is_object($elmt) && is_a($elmt, Attribute::class)) {
            if (true === $unique) {
                $this->elements[$elmt->getTag()] = $elmt;
            } else {
                $this->elements[] = $elmt;
            }
        } else {
            $this->setElement(self::create($elmt), $unique);
        }
    }

    /**
     * @param array $elements
     *
     * @return XMLTag
     * @throws OException
     */
    protected function setElements(array $elements): XMLTag
    {
        foreach ($elements as $element) {
            if (!is_a($element, XMLTag::class)) {
                continue;
            }
            $this->addElement($element);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTagspace()
    {
        return $this->tag_space;
    }

    /**
     * @param mixed $tag_space
     *
     * @return XMLTag
     */
    protected function setTagspace($tag_space)
    {
        $this->tag_space = $tag_space;
        return $this;
    }

    /**
     * @return string
     */
    protected function getNamespaceUrl()
    {
        return NS::url($this->tag_space);
    }
}