<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:48 PM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;


trait TraitBinding
{
    protected $binding;

    protected function setBinding($name)
    {
        $this->binding = Bind::create($name);
    }
}