<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:26 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;


class Ns
{
    public const XFORMSLIST     = 'http://openrosa.org/xforms/xformsList';
    public const XFORMSMANIFEST = 'http://openrosa.org/xforms/xformsManifest';
    public const H              = 'http://www.w3.org/1999/xhtml';
    public const JR             = 'http://openrosa.org/javarosa';
    public const XSD            = 'http://www.w3.org/2001/XMLSchema';
    public const RESPONSE       = 'http://openrosa.org/http/response';
    public const ORX            = 'http://openrosa.org/xforms';
    public const ODK            = 'http://www.opendatakit.org/xforms';
    public const XMLNS          = 'http://www.w3.org/2002/xforms';

    private static $collection = [];

    public static function uri($name)
    {
        return \constant(self::class . '::' . strtoupper($name));
    }

    /**
     * @return array
     */
    public static function getCollection(): array
    {
        $mp = [];
        foreach (self::$collection as $ns) {
            if (!$ns || !self::uri($ns)) continue;
            $mp[$ns] = self::uri($ns);
        }
        return $mp;
    }

    /**
     * @param array $collection
     */
    public static function setCollection(array $collection): void
    {
        self::$collection = $collection;
    }

    public static function collect($ns)
    {
        self::$collection[] = $ns;
        self::setCollection(array_unique(self::$collection));
    }
}