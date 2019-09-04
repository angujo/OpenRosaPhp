<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Support\CanBeNoded;
use Angujo\OpenRosaPhp\Support\Labelable;

/**
 * Class Group
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Group extends InterfaceElement
{
    use CanBeNoded, Labelable;

    public function __construct($name = null)
    {
        parent::__construct('group');
        if ($name) {
            $this->setRef($name);
        }
    }

    /**
     * @param null $name
     *
     * @return Group
     * @throws OException
     */
    public static function create($name = null)
    {
        return new self($name);
    }

    /**
     * @param null $name
     *
     * @return Group
     * @throws OException
     */
    public static function OneScreen($name = null)
    {
        $me = new self($name);
        $me->addAttribute('appearance', 'field-list');
        return $me;
    }
}