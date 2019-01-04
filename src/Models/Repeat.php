<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 12:20 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Models\Elements\Bind;

class Repeat extends ControlHolder
{
    protected $no_ref;

    protected function __construct($name = null)
    {
        $name = $name ?: uniqid('ch', false);
        parent::__construct(Elmt::REPEAT, $name);
    }

    /**
     * @param null|string $name
     * @return Repeat
     */
    public static function create($name = null)
    {
        return new self($name);
    }

    /**
     * @param int $times
     * @return $this
     */
    public function count($times)
    {
        $times = !is_numeric($times) ? 2 : (int)$times;
        return $this->addNSAttribute('jr', 'count', $times);
    }
}