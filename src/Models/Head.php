<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:55 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Head\Model;

class Head extends Tag
{
    /** @var Tag|Model */
    private $model;

    protected function __construct($title)
    {
        parent::__construct(Elmt::HEAD, null);
        $this->addNSUniqueTag('h', 'title', $title);
        $this->setNamespace('h');
        $this->model = $this->setUniqueTag(Model::create());
    }

    public static function set($title)
    {
        $me = new self($title);
        return $me;
    }

    public function title($title)
    {
        $this->addNSUniqueTag('h', 'title', $title);
        return $this;
    }

    public function id($id)
    {
        $this->model->setId($id);
        return $this;
    }

    public function version($id)
    {
        $this->model->setVersion($id);
        return $this;
    }

    public function rootElement($tag)
    {
        $this->model->rootElement($tag);
        return $this;
    }

    /**
     * @return Tag|Model
     */
    public function getModel()
    {
        return $this->model;
    }
}