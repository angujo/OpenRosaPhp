<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:05 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

abstract class InstanceAbstract extends Tag
{
    private $id;
    protected $rootTag = 'root';

    protected function __construct($id = null)
    {
        parent::__construct(Elmt::INSTANCE, null);
        if ($id) $this->setId($id);
    }

    /**
     * @return Tag
     */
    public function getRootTag(): Tag
    {
        return $this->getUniqueTag($this->rootTag);
    }

    /**
     * @param string $rootTag
     * @return InstanceAbstract
     */
    public function setRootTag($rootTag = null): InstanceAbstract
    {
        $this->rootTag = $rootTag ?: 'root';
        $this->addUniqueTag($this->rootTag, null);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return InstanceAbstract
     */
    public function setId($id)
    {
        $this->id = $id;
        $this->setAttribute('id', $id);
        return $this;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        return $this->setNSAttribute('orx', 'version', $version);
    }

    /**
     * @param $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        return $this->setNSAttribute('odk', 'prefix', $prefix);
    }

    /**
     * @param $delimiter
     * @return $this
     */
    public function setDelimiter($delimiter)
    {
        return $this->setNSAttribute('odk', 'delimiter', $delimiter);
    }

    /**
     * @param $tag
     * @return $this
     */
    public function setTagValue($tag)
    {
        return $this->setNSAttribute('odk', 'tag', $tag);
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        return $this->setNSAttribute('jr', 'template', $template);
    }

    /**
     * @param $source_path
     * @return $this
     */
    public function setSource($source_path)
    {
        return $this->setAttribute('src', $source_path);
    }
}