<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 12:56 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;


/**
 * Class Body
 * @package Angujo\OpenRosaPhp\Models
 */
class Body extends ControlHolder
{
    private static $me;
    protected      $no_ref;
    protected      $no_bind;

    /**
     * @return Body|Tag
     */
    public static function create()
    {
        if (self::$me) return self::$me;
        return self::$me = (new self(Elmt::BODY, null))->setNamespace('h');
    }

    public function setRootElement($root)
    {
        $this->parentPath([$root]);
        return $this;
    }
}