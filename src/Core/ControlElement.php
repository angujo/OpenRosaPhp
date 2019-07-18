<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Support\CanBeBound;
use Angujo\OpenRosaPhp\Support\CanBeRef;
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
    use CanHaveHint, Labelable, CanBeBound, CanBeRef;

    protected static $elmts = ['input', 'select1', 'select', 'upload', 'trigger', 'range', 'odkrank',];
    protected $ref_id;

    public function __construct($tag, $name)
    {
        $tag = strtolower($tag);
        if (!in_array($tag, self::$elmts)) {
            throw new OException($tag.' is an invalid Body Element!');
        }
        if (0 === strcasecmp('odkrank', $tag)) {
            $this->tag_space = 'odk';
            $tag             = 'rank';
        }
        parent::__construct($tag);
        $this->setRef((string)preg_replace('/[^a-z0-9]/i','-',$name));
        $this->ref_id = uniqid('ce', true);
    }
}