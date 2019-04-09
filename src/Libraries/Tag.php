<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:40 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;


use Angujo\OpenRosaPhp\Models\Config;
use Angujo\OpenRosaPhp\Models\Elements\Translatable;


/**
 * Class Tag
 * @package Angujo\OpenRosaPhp\Libraries
 *
 */
class Tag
{
    /** @var string */
    private $name;
    /** @var string */
    protected $namespace;
    /** @var Attribute[] */
    protected $attributes = [];
    /** @var string */
    protected $value;
    /** @var Tag[] */
    protected $tags = [];
    
    
    protected function __construct($name, $value = NULL)
    {
        $this->setName($name);
        $this->setValue($value);
    }
    
    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
    
    /**
     * @param string $namespace
     *
     * @return Tag
     */
    protected function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;
        if (Config::isOdk()) Ns::collect($this->namespace);
        return $this;
    }
    
    /**
     * @param null|string $className
     *
     * @return Tag[]
     */
    public function getTags($className = NULL)
    {
        return $className && \is_string($className) && class_exists($className, FALSE) ? array_filter(
            array_map(function ($tag) use ($className) { return is_a($tag, $className) ? $tag : NULL; }, $this->tags)
        ) : $this->tags;
    }
    
    public function setGetTag(Tag $tag)
    {
        return isset($this->tags[$tag->getName()]) ?$this->tags[$tag->getName()]: $this->setTag($tag);
    }
    
    /**
     * @param Tag[] $tags
     *
     * @return Tag
     */
    public function setTags(array $tags)
    {
        $this->tags = [];
        return $this->appendTags($tags);
    }
    
    /**
     * @param array $tags
     *
     * @return $this
     */
    public function appendTags(array $tags)
    {
        foreach ($tags as $name => $tag) {
            if (\is_object($tag) && is_a($tag, Tag::class)) $this->setTag($tag);
            else $this->addTag($name, $tag);
        }
        return $this;
    }
    
    /**
     * @param string $name
     * @param string $value
     *
     * @return Tag
     */
    public function addTag($name, $value)
    {
        $this->tags[] = $tag = self::raw($name, $value);
        return $tag;
    }
    
    public function identifiedTag(Tag $tag, $id)
    {
        $this->tags[$id] = $tag;
        return $tag;
    }
    
    public function addUniqueTag($name, $value)
    {
        $this->tags[$name] = $tag = self::raw($name, $value);
        return $tag;
    }
    
    public function addNSUniqueTag($namespace, $name, $value)
    {
        $this->tags[$namespace . $name] = $tag = self::raw($name, $value)->setNamespace($namespace);
        return $tag;
    }
    
    /**
     * @return Tag
     */
    public function getUniqueTag($name)
    {
        return isset($this->tags[$name]) ?$this->tags[$name]: NULL;
    }
    
    /**
     * @param Tag $tag
     *
     * @return Tag
     */
    public function setTag(Tag $tag)
    {
        $this->tags[] = $tag;
        return $tag;
    }
    
    /**
     * @param Tag $tag
     *
     * @return Tag
     */
    public function setUniqueTag(Tag $tag)
    {
        $this->tags[$tag->getName()] = $tag;
        return $tag;
    }
    
    /**
     * @param $name
     * @param $value
     *
     * @return Tag
     */
    public static function raw($name, $value)
    {
        return new self($name, $value);
    }
    
    public static function emptyTag($name)
    {
        return new self($name, NULL);
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     *
     * @return Tag
     */
    private function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function changeName($name)
    {
        return $this->setName($name);
    }
    
    /**
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * @param Attribute[] $attributes
     *
     * @return Tag
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $name => $attribute) {
            if (\is_object($attribute) && is_a($attribute, Attribute::class)) $this->attributes[$attribute->getNamespace() . $attribute->getName()] = $attribute;
            elseif (!is_numeric($name) && \is_string($attribute)) $this->addAttribute($name, $attribute);
        }
        return $this;
    }
    
    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($name, $value)
    {
        return $this->addAttribute($name, $value);
    }
    
    /**
     * @param $namespace
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setNSAttribute($namespace, $name, $value)
    {
        return $this->addNSAttribute($namespace, $name, $value);
    }
    
    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = Attribute::create($name, $value);
        return $this;
    }
    
    /**
     * @param $namespace
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function addNSAttribute($namespace, $name, $value)
    {
        $this->attributes[$namespace . $name] = Attribute::namespaced($namespace, $name, $value);
        return $this;
    }
    
    /**
     * @param $name
     * @param $value
     *
     * @return \Angujo\OpenRosaPhp\Libraries\Attribute
     */
    public function _addAttribute($name, $value)
    {
        $this->addAttribute($name, $value);
        return $this->attributes[$name];
    }
    
    /**
     * @param $namespace
     * @param $name
     * @param $value
     *
     * @return \Angujo\OpenRosaPhp\Libraries\Attribute
     */
    public function _addNSAttribute($namespace, $name, $value)
    {
        $this->addNSAttribute($namespace, $name, $value);
        return $this->attributes[$namespace . $name];
    }
    
    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @param mixed $value
     *
     * @return Tag
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * @param \XMLWriter|null $xmlwriter
     *
     * @return string|\XMLWriter
     */
    public function XMLify($xmlwriter = NULL)
    {
        $continue = $xmlwriter && \is_object($xmlwriter) && is_a($xmlwriter, \XMLWriter::class);
        /** @var \XMLWriter $writer */
        $writer = $xmlwriter ?: new \XMLWriter();
        if (!$continue) {
            $writer->openMemory();
            $writer->startDocument();
        }
        if ($this->namespace) {
            $writer->startElementNS($this->namespace, $this->name, NULL);
        } else {
            $writer->startElement($this->name);
        }
        foreach ($this->attributes as $attribute) {
            if ($attribute->isIgnored()) continue;
            if ($attribute->getNamespace()) {
                $writer->writeAttributeNS($attribute->getNamespace(), $attribute->getName(), NULL, $attribute->getValue());
            } else {
                $writer->writeAttribute($attribute->getName(), $attribute->getValue());
            }
        }
        if (!$continue) {
            //if ($nspaces = $this->collectNameSpaces()) $writer->writeAttribute('xmlns', Ns::XMLNS);
            /*foreach ($nspaces as $ns) {
                if ($uri = Ns::uri($ns)) $writer->writeAttributeNS('xmlns', $ns, null, $uri);
            }*/
            if (Ns::getCollection()) $writer->writeAttribute('xmlns', Ns::XMLNS);
            foreach (Ns::getCollection() as $ns => $uri) {
                $writer->writeAttributeNS('xmlns', $ns, NULL, $uri);
            }
        }
        if (!$this->tags) {
            if (strlen($this->value)) {
                if (is_a($this, Translatable::class) && method_exists($this, 'getIdPath')) {
                    $writer->writeAttribute('ref', 'jr:itext(\'' . $this->getIdPath() . '\')');
                }
                $writer->text($this->value);
            }
        } else {
            foreach ($this->tags as $tag) {
                $tag->XMLify($writer);
            }
        }
        $writer->endElement();
        if (!$continue) {
            $writer->endDocument();
            return $writer->outputMemory();
        }
        return $writer;
    }
    
    /*public function collectNameSpaces()
    {
        $nsCollector = [];
        if ($this->namespace) $nsCollector[] = $this->namespace;
        foreach ($this->attributes as $attribute) {
            if ($attribute->getNamespace()) $nsCollector[] = $attribute->getNamespace();
        }
        foreach ($this->tags as $tag) {
           // $nsCollector = array_merge($nsCollector, $tag->collectNameSpaces());
        }
        return array_unique($nsCollector);
    }

    public function collector(Tag $tagger)
    {
        /** @var ControlElement|ControlHolder|Translatable $tag
        foreach ($this->tags as $tag) {
            if (!is_a($tag, BodyElement::class) || !$tag->isRegistered()){
                continue;
            }
            if (is_a($tag, ControlHolder::class)) {
                $tag->collector($tagger->addUniqueTag($tag->getBasePath(), null));
            } elseif (is_a($tag, ControlElement::class)) {
                $tagger->addUniqueTag($tag->getBasePath(), $tag->getDefaultValue());
            }
        }
    }*/
    
}
