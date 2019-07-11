<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;

/**
 * Class Body
 *
 * @package Angujo\OpenRosaPhp\Models
 *
 * @inheritDoc
 */
class Body extends InterfaceElement
{
    public function __construct()
    {
        parent::__construct('body');
        $this->tag_space = 'h';
    }
}