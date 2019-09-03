<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\NS;
use Angujo\OpenRosaPhp\ODKForm;
use Angujo\OpenRosaPhp\Support\TranslatedAttribute;
use Angujo\OpenRosaPhp\Support\TricklesNode;
use Angujo\OpenRosaPhp\Utils\Helper;

class XMLTag
{
    use TricklesNode;

    private $tag;
    /** @var TranslatedAttribute[]|Attribute[] */
    protected $attributes = [];
    /** @var XMLTag[] */
    protected $elements = [];
    protected $tag_space;
    protected $content;

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
     * @param null             $val
     *
     * @return $this
     * @throws OException
     */
    protected function addAttribute($attr, $val = null)
    {
        if (is_object($attr) && is_a($attr, Attribute::class)) {
            $this->attributes[$attr->getFullName()] = $attr;
        } else {
            return $this->addAttribute(Attribute::create($attr, $val));
        }
        return $this;
    }

    /**
     * @param $name
     *
     * @return Attribute|TranslatedAttribute|null
     */
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
    protected function addElementUnq($elmt, $identifier = true)
    {
        $this->setElement($elmt, $identifier);
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
     * @param XMLTag|string $elmt
     * @param bool          $unique
     *
     * @throws OException
     */
    private function setElement($elmt, $unique = false)
    {
        if (is_object($elmt) && is_a($elmt, XMLTag::class)) {
            if (false !== $unique) {
                $this->elements[true === $unique ? $elmt->getTag() : $unique] = $elmt;
            } else {
                $this->elements[] = $elmt;
            }
        } else {
            $this->setElement(new self($elmt), $unique);
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

    public function fullTag()
    {
        return implode(':', array_filter([$this->tag_space, $this->tag]));
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
    protected function getTagSpaceUrl()
    {
        return NS::url($this->tag_space);
    }

    /**
     * @return mixed
     */
    protected function getContent()
    {
        return $this->content;
    }

    protected function setGetElement($name, $content = null)
    {
        if (!$this->hasElement($name)) {
            $this->addElementUnq($name);
        }
        $lmt = $this->getElement($name);
        if ($content) {
            $lmt->setContent($content);
        }
        return $lmt;
    }

    /**
     * @param mixed $content
     *
     * @return XMLTag
     */
    protected function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param \DOMElement|\DOMDocument $writer
     * @param null|\DOMDocument        $root
     *
     * @return \DOMElement
     * @throws OException
     */
    public function toXML($writer, $root = null)
    {
        $root = $root && is_object($root) && is_a($root, \DOMDocument::class) ? $root : ODKForm::get();
        if ($this->tag_space) {
            $elmt = $root->createElementNS($this->getTagSpaceUrl(), $this->fullTag(), $this->content ?: null);
        } else {
            $elmt = $root->createElement($this->tag, strlen(trim($this->content.'')) > 0 ? trim($this->content.'') : null);
        }
        $writer->appendChild($elmt);
        foreach ($this->attributes as $attribute) {
            if ($attribute->getNamespace()) {
                $elmt->setAttributeNS($attribute->getNamespaceUrl(), $attribute->getFullName(), (string)$attribute->getValue());
            } else {
                $elmt->setAttribute($attribute->getName(), (string)$attribute->getValue());
            }
        }
        if (!$this->content) {
            foreach ($this->elements as $element) {
                $element->toXML($elmt);
            }
        }
        return $elmt;
    }
}