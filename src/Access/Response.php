<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 6:47 AM
 */

namespace Angujo\OpenRosaPhp\Access;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class Response extends Tag
{
    /** @var Tag */
    private $message;
    /** @var bool */
    private $success = true;
    /** @var Response */
    private static $me;

    protected function __construct($message, $success = true)
    {
        parent::__construct(Elmt::OPENROSARESPONSE, null);
        $this->message = $message;
        $this->success = $success;
    }

    protected static function init($msg, $status = true)
    {
        return self::$me = self::$me ?: new self($msg, $status);
    }

    public static function error($message)
    {

    }
}