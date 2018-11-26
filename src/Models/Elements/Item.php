<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:46 PM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class Item extends Tag
{
    protected function __construct() { parent::__construct(Elmt::ITEM, null); }

    /**
     * @return static|Tag
     */
    public static function create()
    {
        return new self();
    }

    public static function asOption($path, $label, $value)
    {
        $me = new self();
        $me->setValueTag($value);
        $me->setLabel($label)->setIdPath($path);
        return $me;
    }

    public function setValueTag($value)
    {
        return $this->addUniqueTag(Elmt::VALUE, $value);
    }

    /**
     * @return Tag|null|Label
     */
    public function getLabel()
    {
        return $this->getUniqueTag(Elmt::LABEL);
    }

    /**
     * @param $value
     * @return Tag|Label
     */
    public function setLabel($value)
    {
        return $this->setUniqueTag(Label::create($value));
    }

    public function setItextID($value)
    {
        return $this->addUniqueTag(Elmt::ITEXTID, $value);
    }

    public function addElement($name, $value)
    {
        return $this->addUniqueTag($name, $value);
    }

    public function parentPath($path)
    {
        $this->getLabel()->setIdPath($path);
    }
}