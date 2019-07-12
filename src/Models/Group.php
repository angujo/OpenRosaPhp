<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;

/**
 * Class Group
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Group extends InterfaceElement
{
    public function __construct($name = null)
    {
        parent::__construct('group');
        if ($name) {
            $this->setRef($name);
        }
    }
}