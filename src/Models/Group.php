<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Support\CanBeNoded;

/**
 * Class Group
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Group extends InterfaceElement
{
    use CanBeNoded;
    public function __construct($name = null)
    {
        parent::__construct('group');
        if ($name) {
            $this->setRef($name);
        }
    }
}