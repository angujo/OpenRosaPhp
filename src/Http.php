<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 4:35 AM
 */

namespace Angujo\OpenRosaPhp;

use Angujo\OpenRosaPhp\Access\Authenticate;
use Angujo\OpenRosaPhp\Access\Response;
use Angujo\OpenRosaPhp\Utils\Helper;
use Angujo\OpenRosaPhp\Utils\Log;

/**
 * Class Access
 * @package Angujo\OpenRosaPhp
 */
class Http extends Authenticate
{

    public static function formListing(FormList $formList)
    {
        if (!self::$valid) {
            self::validateUser(function () { return ''; });
        }

        echo $formList->asXML();
        exit;
    }

    public function manifest(Manifest $manifest)
    {
        if (!self::$valid) {
            self::validateUser(function () { return ''; });
        }
        echo $manifest->asXML();
        exit;
    }

    public static function formOutput(ODKForm $form)
    {
        if (!self::$valid) {
            self::validateUser(function () { return ''; });
        }

        echo $form->asXML();
        exit;
    }

    public static function submission(\Closure $getData, $file_name = 'xml_submission_file')
    {
        if (!self::$valid) {
            self::validateUser(function () { return ''; });
        }

        self::submissionHeaders();
        if (self::isHeadRequest()) {
            self::inHead();
        }

        self::posted($getData, $file_name);
    }

    public static function transaction(\Closure $closure, $msg = 'Entry successful!')
    {
        try {
            if (is_callable($closure)) $closure();
            echo Response::success($msg)->asXML();
        } catch (\Throwable $throwable) {
            echo Response::error($throwable->getCode() . ': ' . $throwable->getMessage())->asXML();
            Log::error($throwable->getMessage()."\n".$throwable->getTraceAsString());
        } finally {
            exit;
        }
    }

    protected static function inHead()
    {
        header('HTTP/1.1 204 No Content');
        exit;
    }

    protected static function posted(\Closure $data, $file_name)
    {
        if (!self::isPostRequest()) {
            header('HTTP/1.1 400 Bad request method');
            exit;
        }
        $content = self::fileContent($file_name);
        Log::info('UPLOAD: ' . $content);
        try {
            $data(Helper::xmlToArray(simplexml_load_string($content)));
            header('HTTP/1.1 201 Received');
            echo Response::success('Submission successfully received!')->asXML();
        } catch (\Throwable $th) {
            echo Response::error($th->getCode() . ': ' . $th->getMessage())->asXML();
            Log::error($th->getMessage()."\n".$th->getTraceAsString());
        } finally {
            exit;
        }
    }

}
