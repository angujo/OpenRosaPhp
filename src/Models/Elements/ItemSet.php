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

class ItemSet extends Tag
{
    /**
     * @param $value
     * @return static|Tag
     */
    public static function create($value)
    {
        return parent::raw(Elmt::ITEMSET, $value);
    }

    public function setValueTag($value)
    {
        return $this->addTag(Elmt::VALUE, $value);
    }

    public function setLabel($value)
    {
        return $this->addTag(Elmt::LABEL, $value);
    }
}