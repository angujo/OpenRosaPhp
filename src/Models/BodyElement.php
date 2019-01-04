<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 4:16 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Element;
use Angujo\OpenRosaPhp\Libraries\Elements;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Bind;
use Angujo\OpenRosaPhp\Models\Elements\Translatable;
use Angujo\OpenRosaPhp\Utils\Helper;

class BodyElement extends Tag
{
    /** @var string */
    protected $path;
    /** @var string */
    protected $old_path;
    /** @var array */
    private $xpath = [];
    /** @var string */
    protected $id;
    /** @var Bind|null */
    protected $bind;
    /** @var Element|null */
    protected $element;
    
    protected $registered = FALSE;
    
    protected function __construct($name, $path)
    {
        parent::__construct($name, NULL);
        $this->path = $this->old_path = Helper::xmlName($path);
        $this->id   = uniqid('elm', TRUE);
        $this->setPath();
    }
    
    public function isRegistered()
    {
        return $this->registered;
    }
    
    public function register()
    {
        $this->registered = TRUE;
        //if (Binds::get($this->id)) Binds::get($this->id)->setRegistered($this->registered);
    }
    
    private function setBind()
    {
        //if (Config::isOdk() && Binds::get($this->id)) Binds::get($this->id)->nodeset($this->getPath());
        if ($this->bind && Config::isOdk()) $this->bind->nodeset($this->getPath());
    }
    
    /**
     * @return array
     */
    public function getXpath(): array
    {
        return !is_a($this, Repeat::class) ? array_merge($this->xpath, [$this->path]) : $this->xpath;
    }
    
    /**
     * @return mixed
     */
    public function getPath()
    {
        $xpath = $this->xpath;
        if (!is_a($this, Repeat::class)) $xpath[] = $this->path;
        return '/' . implode('/', $xpath);
    }
    
    public function getBasePath()
    {
        return $this->path;
    }
    
    /**
     * @return BodyElement
     */
    public function setPath()
    {
        $this->setXpath();
        return $this;
    }
    
    public function parentPath(array $xpath)
    {
        $this->old_path = $this->getPath();
        $this->xpath    = array_filter($xpath, 'trim');
        $this->setXpath();
        return $this;
    }
    
    private function setXpath()
    {
        if (Config::isOdk()) Elements::changeName($this->old_path, $this->getPath(), method_exists($this, 'getDefaultValue') ? $this->getDefaultValue() : NULL);
        if (!property_exists($this, 'no_ref') || (property_exists($this, 'hold_repeat') && true===$this->hold_repeat)) $this->setAttribute('ref', $this->getPath());
        if (is_a($this, Repeat::class)) $this->setAttribute('nodeset', $this->getPath());
        $this->setBind();
        /** @var BodyElement|Translatable $tag */
        foreach ($this->tags as $tag) {
            if (is_a($tag, __CLASS__)) $tag->parentPath($this->getXpath());
            if (is_a($tag, Translatable::class)) $tag->setIdPath($this->getPath());
        }
    }
}