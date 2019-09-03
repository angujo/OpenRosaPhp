<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\Labelable;
use Angujo\OpenRosaPhp\Support\PassessNodeset;
use Angujo\OpenRosaPhp\Support\ValueTag;
use Angujo\OpenRosaPhp\Tag;

class Option extends XMLTag
{
    use Labelable, PassessNodeset;
    private $_myref;

    public function __construct()
    {
        parent::__construct(Tag::ITEM);
      //  $this->getLabelTranslation()->setNode($this->_myref);
    }

    /**
     * @param      $value
     * @param      $label
     *
     * @param null $index_ref
     *
     * @return Option
     * @throws OException
     */
    public static function create($value, $label, $index_ref = null)
    {
        ($me = new self())->setLabel($label);
        $me->setValue($value);
        if ($index_ref) {
            $me->setRef($index_ref);
        }
        return $me;
    }

    public function setRef($ref, $node = false)
    {
        if (!$ref) {
            return $this;
        }
        if (true === $node) {
            $this->_myref = '/'.implode('/', $ref).'/'.$this->_myref;
        } else {
            $this->_myref = implode('/', $this->fullNodeSet()).':'.preg_replace(['/[^\w]+/i', '/(^_|_$)/i'], ['_', ''], strtolower($ref));
        }
        $this->getLabelElement()->setRef($this->_myref);
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     * @throws OException
     */
    public function setValue($value)
    {
        if ($this->getElement(Tag::VALUE)) {
            $this->getElement(Tag::VALUE);
        }
        $this->addElementUnq(new ValueTag(Tag::VALUE, $value, true));
        return $this;
    }

    public function getValue()
    {
        return $this->hasElement(Tag::VALUE) ? $this->getElement(Tag::VALUE)->getValue() : null;
    }
}