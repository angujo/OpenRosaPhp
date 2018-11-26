<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 11:49 PM
 */

namespace Angujo\OpenRosaPhp\Models;

use Angujo\OpenRosaPhp\Libraries\Binds;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Bind;
use Angujo\OpenRosaPhp\Models\Elements\Label;
use Angujo\OpenRosaPhp\Models\Elements\Translatable;

/**
 * Class ControlElement
 * @package Angujo\OpenRosaPhp\Models
 */
class ControlElement extends BodyElement
{
    /** @var string|int|null */
    protected $defaultValue;

    protected function __construct($name, $path)
    {
        parent::__construct($name, $path);
       if (Config::isOdk()) Binds::add(Bind::create($this->getPath()),$this->id);
    }

    /**
     * @return int|null|string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param $value
     * @return Tag|Label
     */
    public function label($value)
    {
        if ($tag=$this->getUniqueTag(Elmt::LABEL)) return $tag->setValue($value);
        return $this->setTag(Label::create($value)->setIdPath($this->getPath()));
    }

    /**
     * @param $value
     * @return Tag|Translatable
     */
    public function hint($value)
    {
        if ($tag = $this->getUniqueTag(Elmt::HINT)) {
            return $tag->setValue($value);
        }
        return $this->setUniqueTag(Translatable::raw(Elmt::HINT, $value));
    }

    public function defaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    protected function setType($type)
    {
        if (Config::isOdk()) Binds::get($this->id)->addAttribute('type', $type);
        else $this->setAttribute('type', $type);
        return $this;
    }

    /**
     * @param string $app
     * @return $this
     */
    protected function setAppearance($app)
    {
        $this->addAttribute('appearance', $app);
        return $this;
    }
}