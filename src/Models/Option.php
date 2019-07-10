<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\Labelable;
use Angujo\OpenRosaPhp\Support\Translation;
use Angujo\OpenRosaPhp\Support\ValueTag;
use Angujo\OpenRosaPhp\Tag;

class Option extends XMLTag
{
    use Labelable;

    public function __construct(){ parent::__construct(Tag::ITEM); }

    /**
     * @param $value
     * @param $label
     *
     * @return Option
     * @throws OException
     */
    public static function create($value, $label)
    {
        ($me = new self())->setValue($value)->setLabel($label);
        return $me;
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
        $this->addElementUnq(new ValueTag(Tag::VALUE, $value));
        return $this;
    }

    public function getValue()
    {
        return $this->hasElement(Tag::VALUE) ? $this->getElement(Tag::VALUE)->getValue() : null;
    }
}