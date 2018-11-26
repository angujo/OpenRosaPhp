<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 12:20 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\Label;

class Group extends ControlHolder
{
    protected $no_ref;

    protected function __construct($name = null)
    {
        $name = $name ?: uniqid('ch', false);
        parent::__construct(Elmt::GROUP, $name);
    }

    public static function create($name = null)
    {
        return new self($name);
    }

    /**
     * @param $value
     * @return Label|Tag
     */
    public function setLabel($value)
    {
        return $this->setUniqueTag(Label::create($value));
    }
}