<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 6:44 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Models\ControlElement;

class Upload extends ControlElement
{
    /**
     * Upload constructor.
     * @param string $name
     */
    protected function __construct($name)
    {
        parent::__construct(Elmt::INPUT, $name);
        $this->setType('binary');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function image($name)
    {
        return (new self($name))->addAttribute('mediatype', 'image/*');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function audio($name)
    {
        return (new self($name))->addAttribute('mediatype', 'audio/*');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function video($name)
    {
        return (new self($name))->addAttribute('mediatype', 'video/*');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function barcode($name)
    {
        return (new self($name))->setType('barcode');
    }

    /**
     * @param string $name
     * @return $this
     */
    public static function file($name)
    {
        $types[] = 'application/vnd.ms-excel';
        $types[] = 'application/pdf';
        $types[] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $types[] = 'application/msword';
        $types[] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        $types[] = 'application/rtf';
        $types[] = 'application/zip';
        $types[] = 'text/plain';
        return (new self($name))->addAttribute('accept', implode(',', $types));
    }

    public static function custom($name, array $mimes)
    {
        return (new self($name))->addAttribute('accept', implode(',', $mimes));
    }
}