<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 4:38 AM
 */

namespace Angujo\OpenRosaPhp\Access;


use Angujo\OpenRosaPhp\Authentication\Access;
use Angujo\OpenRosaPhp\Utils\Helper;

abstract class Authenticate
{

    protected static $valid = false;

    protected static function headers()
    {
        header('X-OpenRosa-Version:1.0');
        header('Content-Type:text/xml;charset=utf-8');
    }

    protected static function submissionHeaders()
    {
        header('X-OpenRosa-Accept-Content-Length: ' . Helper::byteconvert(ini_get('post_max_size')));
    }

    public static function validateUser(\Closure $closure)
    {
        Access::authenticateByHA1(function ($username) use ($closure) {
            $password = !\is_string($password = $closure($username)) ? '' : $password;
            return md5($username . ':' . Access::getRealm() . ':' . $password);
        });
        self::headers();
        self::$valid = true;
    }

    /**
     * @return bool
     */
    public static function isHeadRequest()
    {
        return 0 === strcasecmp($_SERVER['REQUEST_METHOD'], 'head');
    }

    public static function isPostRequest()
    {
        return 0 === strcasecmp($_SERVER['REQUEST_METHOD'], 'post');
    }

    protected static function fileContent($file_name)
    {
        if (empty($_FILES[$file_name])) {
            header('HTTP/1.1 406 No Submission');
            exit;
        }

        $content= file_get_contents($_FILES[$file_name]['tmp_name']);
        if (self::inValidXML($content)){
            header('HTTP/1.1 406 Invalid XML Submission');
            exit;
        }
        return $content;
    }

    protected static function inValidXML($content)
    {
        libxml_use_internal_errors(true);
        return !simplexml_load_string($content);
    }
}