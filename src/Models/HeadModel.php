<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\Bind;
use Angujo\OpenRosaPhp\Core\XMLTag;

/**
 * Class HeadModel
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class HeadModel extends XMLTag
{
    public function addBind(Bind $bind)
    {
        $this->addElement($bind);
        return $this;
    }
}