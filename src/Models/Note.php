<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2019-10-06
 * Time: 8:00 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;
use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Support\Translation;

class Note extends ControlElement
{
    public function __construct($name)
    {
        parent::__construct('input', $name);
        $this->getBind()->setReadOnly(true);
    }

    public static function create($name, $content)
    {
        $content = empty($content) ? '[NO CONTENT]' : $content;
        $me      = new self($name);
        $me->setLabel($content);
        return $me;
    }

    /**
     * @param $content
     * @return Translation
     * @throws OException
     */
    public function content($content)
    {
        return $this->setLabel($content);
    }
}