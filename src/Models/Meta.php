<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2020-01-08
 * Time: 3:10 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\CanBeBound;

class Meta extends XMLTag
{
    use CanBeBound;

    public function __construct() { parent::__construct('meta'); }
}