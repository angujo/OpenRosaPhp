<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:27 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Item;

class Instance extends InstanceAbstract
{
    /**
     * @return Tag|Item
     */
    public function addItem()
    {
        if (!$this->getRootTag()) $this->setRootTag();
        return $this->getRootTag()->setTag(Item::create());
    }
}