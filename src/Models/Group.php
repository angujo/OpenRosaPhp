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
    public    $hold_repeat = FALSE;
    
    protected function __construct($name = NULL)
    {
        $name = $name ?: uniqid('ch', FALSE);
        parent::__construct(Elmt::GROUP, $name);
    }
    
    public static function create($name = NULL)
    {
        return new self($name);
    }
    
    /**
     * @param $name
     *
     * @return \Angujo\OpenRosaPhp\Libraries\Tag|\Angujo\OpenRosaPhp\Models\Repeat
     */
    public static function forRepeat($name)
    {
        $me              = self::create($name);
        $me->hold_repeat = TRUE;
        return $me;
    }
    
    /**
     * @param $value
     *
     * @return Label|Tag
     */
    public function setLabel($value)
    {
        /** @var Label $label */
        $label = $this->setUniqueTag(Label::create($value));
        $label->setIdPath($this->getPath());
        return $label;
    }
}