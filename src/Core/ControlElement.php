<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Support\Labelable;

/**
 * Class ControlElement
 *
 * @package Angujo\OpenRosaPhp\Core
 *
 */
class ControlElement extends XMLTag
{
    use Labelable;

    protected static $elements = ['input', 'select1', 'select', 'upload', 'trigger', 'range', 'odkrank',];

    public function __construct($tag)
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
    }

}