<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 3:43 PM
 */

namespace Angujo\OpenRosaPhp\Libraries;

use Angujo\OpenRosaPhp\Models\Elements\Bind;

class Binds
{
    private static $me;
    /** @var Bind[] */
    private $binds = [];

    /**
     * @return Binds
     */
    public static function init()
    {
        return self::$me = self::$me ?: new self();
    }

    /**
     * @param Bind $bind
     * @param $id
     */
    public static function &add(Bind $bind, $id)
    {
        return self::init()->binds[$id] = $bind;
    }

    public static function &create($nodeset, $id)
    {
        return self::add(Bind::create($nodeset), $id);
    }

    /**
     * @param $id
     * @return Bind|null
     */
    public static function get($id)
    {
        return self::init()->binds[$id] ?? null;
    }

    /**
     * @param Bind $bind
     * @param $id
     */
    private function set(Bind $bind, $id)
    {
        $this->binds[$id] = $bind;
    }

    /**
     * @param $id
     * @return Bind|null
     */
    private function retrieve($id)
    {
        return $this->binds[$id] ?? null;
    }

    /**
     * @return Bind[]
     */
    public static function all()
    {
        return array_filter(self::init()->binds, function (Bind $bind) {return $bind->isRegistered();});
    }
}
