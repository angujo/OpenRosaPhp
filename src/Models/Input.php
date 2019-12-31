<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Core\OException;

class Input extends ControlElement
{
    public function __construct($name){ parent::__construct('input', $name); }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function Text($name)
    {
        $me = new self($name);
        $me->setType('string');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function TextArea($name)
    {
        $me = new self($name);
        $me->setType('string');
        $me->setAppearance('multiline');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function NumberInteger($name)
    {
        $me = new self($name);
        $me->setType('int');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function NumberDecimal($name)
    {
        $me = new self($name);
        $me->setType('decimal');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function BooleanType($name)
    {
        $me = new self($name);
        $me->setType('boolean');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function DateType($name)
    {
        $me = new self($name);
        $me->setType('date');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function DateMonthYear($name)
    {
        $me = new self($name);
        $me->setType('month-year');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function DateYear($name)
    {
        $me = new self($name);
        $me->setType('year');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function TimeType($name)
    {
        $me = new self($name);
        $me->setType('time');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function DateTime($name)
    {
        $me = new self($name);
        $me->setType('dateTime');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function Barcode($name)
    {
        $me = new self($name);
        $me->setType('barcode');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function Url($name)
    {
        $me = new self($name);
        $me->setType('url');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function Geopoint($name)
    {
        $me = new self($name);
        $me->setType('geopoint');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function GeopointMap($name)
    {
        $me = new self($name);
        $me->setType('geopoint');
        $me->setAppearance('maps');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function GeopointManual($name)
    {
        $me = new self($name);
        $me->setType('geopoint');
        $me->setAppearance('placement-map');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function GeoTrace($name)
    {
        $me = new self($name);
        $me->setType('geotrace');
        return $me;
    }

    /**
     * @param string $name
     *
     * @return Input
     * @throws OException
     */
    public static function GeoShape($name)
    {
        $me = new self($name);
        $me->setType('geoshape');
        return $me;
    }
}