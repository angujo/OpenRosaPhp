<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;

/**
 * Class LangText
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class LangText extends XMLTag
{
    /**
     * LangText constructor.
     *
     * @param $id
     * @param $value
     *
     * @throws \Angujo\OpenRosaPhp\Core\OException
     */
    public function __construct($id, $value)
    {
        parent::__construct('text');
        $this->addAttribute('id', $id);
        $vl = new XMLTag('value');
        $vl->setContent($value);
        $this->addElement($vl);
    }

    /**
     * @param $id
     * @param $value
     *
     * @return LangText
     * @throws \Angujo\OpenRosaPhp\Core\OException
     */
    public static function create($id, $value)
    {
        return new self($id, $value);
    }
}