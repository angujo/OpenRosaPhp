<?php


namespace Angujo\OpenRosaPhp;

/**
 * Class NS
 *To hold namespaces
 *
 * @package Angujo\OpenRosaPhp
 */
class NS
{
    const XFORMSLIST     = 'http://openrosa.org/xforms/xformsList';
    const XFORMSMANIFEST = 'http://openrosa.org/xforms/xformsManifest';
    const H              = 'http://www.w3.org/1999/xhtml';
    const JR             = 'http://openrosa.org/javarosa';
    const XSD            = 'http://www.w3.org/2001/XMLSchema';
    const RESPONSE       = 'http://openrosa.org/http/response';
    const ORX            = 'http://openrosa.org/xforms';
    const ODK            = 'http://www.opendatakit.org/xforms';
    const XMLNS          = 'http://www.w3.org/2002/xforms';

    /**
     * Dynamically get a constant
     *
     * @param $name
     *
     * @return string|null
     */
    public static function url($name)
    {
        $name = strtoupper(trim($name));
        if (!$name || !defined('self::'.$name)) {
            return null;
        }
        return constant('self::'.$name);
    }
}