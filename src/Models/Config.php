<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 10:03 AM
 */

namespace Angujo\OpenRosaPhp\Models;


class Config
{
    public const DEF = 'odk';

    public static function isOdk()
    {
        return 0 === strcasecmp(self::DEF, 'odk');
    }
}