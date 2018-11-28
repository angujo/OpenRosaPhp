<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 4:16 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Binds;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Translatable;

class BodyElement extends Tag
{
    /** @var string */
    protected $path;
    /** @var array */
    private $xpath = [];
    /** @var string */
    protected $id;

    protected $bind;

    protected $registered = false;

    protected function __construct($name, $path)
    {
        parent::__construct($name, null);
        $this->path = $path;
        $this->id = uniqid('elm', true);
        $this->setPath();
    }

    public function isRegistered()
    {
        return $this->registered;
    }

    public function register()
    {
        $this->registered = true;
        if (Binds::get($this->id)) Binds::get($this->id)->setRegistered(true);
    }

    private function setBind()
    {
        if (Config::isOdk() && Binds::get($this->id)) Binds::get($this->id)->nodeset($this->getPath());
    }

    /**
     * @return array
     */
    public function getXpath(): array
    {
        return array_merge($this->xpath, [$this->path]);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        $xpath = $this->xpath;
        $xpath[] = $this->path;
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
        $this->xpath = array_filter($xpath, 'trim');
        $this->setXpath();
        return $this;
    }

    private function setXpath()
    {
        if (!property_exists($this, 'no_ref')) $this->setAttribute('ref', $this->getPath());
        if (is_a($this, Repeat::class)) $this->setAttribute('nodeset', $this->getPath());
        $this->setBind();
        /** @var BodyElement|Translatable $tag */
        foreach ($this->tags as $tag) {
            if (is_a($tag, __CLASS__)) $tag->parentPath($this->getXpath());
            if (is_a($tag, Translatable::class)) $tag->setIdPath($this->getPath());
        }
    }
}