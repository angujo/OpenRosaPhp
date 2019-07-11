<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Support\CanBeBound;
use Angujo\OpenRosaPhp\Support\CanHaveHint;
use Angujo\OpenRosaPhp\Support\Labelable;

/**
 * Class ControlElement
 *
 * @package Angujo\OpenRosaPhp\Core
 *
 */
class ControlElement extends XMLTag
{
    use CanHaveHint, Labelable, CanBeBound;

    protected static $elements = ['input', 'select1', 'select', 'upload', 'trigger', 'range', 'odkrank',];
    protected $name;

    public function __construct($tag, $name)
    {
        $tag = strtolower($tag);
        if (!in_array($tag, self::$elements)) {
            throw new OException($tag.' is an invalid Body Element!');
        }
        if (0 === strcasecmp('odkrank', $tag)) {
            $this->tag_space = 'odk';
            $tag             = 'rank';
        }
        parent::__construct($tag);
        $this->name =(string) $name;
    }

}