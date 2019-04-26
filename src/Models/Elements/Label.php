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

class Label extends Translatable
{

    protected function __construct($value)
    {
        parent::__construct(Elmt::LABEL, $value);
    }

    /**
     * @param $value
     * @return static|Tag
     */
    public static function create($value)
    {
        return new self($value);
    }

    public function setOutput($value)
    {
        return $this->addTag(Elmt::OUTPUT, $value);
    }
}