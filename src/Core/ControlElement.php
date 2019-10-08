<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Support\CanBeBound;
use Angujo\OpenRosaPhp\Support\CanBeRef;
use Angujo\OpenRosaPhp\Support\CanHaveHint;
use Angujo\OpenRosaPhp\Support\Labelable;
use Angujo\OpenRosaPhp\Utils\Helper;

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
            $this->setTagspace('odk');
            $tag = 'rank';
        }
        parent::__construct($tag);
        $this->setRef(Helper::toVariableName($name));
        $this->getLabelTranslation()->setNode($this->translation_ref);
        $this->ref_id = uniqid('ce', true);
        // $this->getLabelElement()->getTranslation()->setNode($this->full_ref);
    }

    /**
     * @param $appear
     * @return ControlElement
     * @throws OException
     */
    protected function setAppearance($appear)
    {
        return $this->addAttribute('appearance', $appear);
    }
}