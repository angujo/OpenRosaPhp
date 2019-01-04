<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 10:04 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\ControlElement;
use Angujo\OpenRosaPhp\Models\Elements\Item;
use Angujo\OpenRosaPhp\Models\Elements\Label;

abstract class OptionBased extends ControlElement
{
    /** @var Item[] */
    protected $options = [];
    
    /**
     * @return Item[]
     */
    public function getOptions(): array
    {
        return $this->getTags(Item::class);
    }
    
    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->getOptions();
    }
    
    /**
     * @param string $label
     * @param string $value
     *
     * @return Label
     */
    public function setItem($label, $value)
    {
        return $this->addOption($label, $value);
    }
    
    /**
     * @param string $label
     * @param string $value
     *
     * @return Label
     */
    public function addOption($label, $value)
    {
        if (NULL === $value || '' === trim($value)) return NULL;
        /** @var Item $option */
        if (!($option = $this->getUniqueTag($value))) {
            $option = $this->identifiedTag(Item::asOption($this->getPath(), $label, $value), $value);
        }
        if (NULL === $option->getLabel()->getIndex()) {
            $option->getLabel()->setIndex(\count($this->getOptions()));
        }
        return $option->getLabel();
    }
    
    public function parentPath(array $xpath)
    {
        parent::parentPath($xpath);
        /** @var Item $tag */
        foreach ($this->getTags(Item::class) as $tag) {
            $tag->parentPath($this->getPath());
        }
        return $this;
    }
}