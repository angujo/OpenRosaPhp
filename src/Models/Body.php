<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\InterfaceElement;
use Angujo\OpenRosaPhp\Support\PassessNodeset;

/**
 * Class Body
 *
 * @package Angujo\OpenRosaPhp\Models
 *
 * @inheritDoc
 */
class Body extends InterfaceElement
{
    use PassessNodeset;

    public function __construct($data_name = null)
    {
        parent::__construct('body');
        $this->tag_space = 'h';
        $this->setNodeset([$data_name]);
    }
}