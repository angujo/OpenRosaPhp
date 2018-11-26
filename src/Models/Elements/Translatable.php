<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 7:41 AM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;


use Angujo\OpenRosaPhp\Libraries\Itext;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Config;
use Angujo\OpenRosaPhp\Models\Controls\LanguageTranslator;

class Translatable extends Tag
{
    /** @var LanguageTranslator */
    public  $language;
    private $idPath;
    private $index;

    protected function __construct($name, $value)
    {
        parent::__construct($name, $value);
        $this->language = LanguageTranslator::default($value);
    }

    public function setValue($value)
    {
        parent::setValue($value);
        if (!$this->language) $this->language = LanguageTranslator::default($value);
        else $this->language->english($value);
    }

    /**
     * @return string
     */
    public function getIdPath()
    {
        return $this->idPath . ':' . $this->getName() . $this->index;
    }

    /**
     * @param string $idPath
     * @return Translatable
     */
    public function setIdPath($idPath)
    {
        $this->idPath = $idPath;
        $this->language->changePaths($this->getIdPath());
        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param int $index
     * @return Translatable
     */
    public function setIndex($index)
    {
        $this->index = (int)$index;
        $this->language->changePaths($this->getIdPath());
        return $this;
    }

    public static function raw($name, $value)
    {
        return new self($name, $value);
    }

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function language(\Closure $closure)
    {
        if (\is_callable($closure)) $closure($this->language);
        return $this;
    }
}