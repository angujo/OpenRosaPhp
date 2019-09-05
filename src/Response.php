<?php


namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Core\DOMLayer;
use Angujo\OpenRosaPhp\Core\FileSubmission;
use Angujo\OpenRosaPhp\Utils\Helper;
use Vyuldashev\XmlToArray\XmlToArray;

/**
 * Class Response
 *
 * @package Angujo\OpenRosaPhp
 */
class Response extends DOMLayer
{
    /** @var \DOMDocument|\DOMElement */
    private static $_dom_rosa;

    private static function getRosaDOM()
    {
        if (self::$_dom_rosa) {
            return self::$_dom_rosa;
        }
        self::$_dom_rosa = self::getDomDocument()->createElement('OpenRosaResponse');
        self::$_dom_rosa->setAttribute('xmlns', 'http://openrosa.org/http/response');
        self::getDomDocument()->appendChild(self::$_dom_rosa);
        return self::$_dom_rosa;
    }

    private static function messageDOM($content)
    {
        $msgDOM = self::getDomDocument()->createElement('message', $content);
        self::getRosaDOM()->appendChild($msgDOM);
        return $msgDOM;
    }

    public static function formODKSubmission($file_name = 'xml_submission_file')
    {
        self::submissionHeaders();
        if (self::isHeadRequest()) {
            self::noContent('No Content!');
        }
        if (!self::isPostRequest()) {
            self::badRequest('Only post requests permitted!');
        }
        // $content = Helper::fileContent($file_name);
        try {
            self::headers();
            $file = FileSubmission::fromFILE($file_name);
        } catch (\Exception $e) {
            self::badRequest($e->getMessage());
        }
        return $file;
    }

    public static function formList()
    {
        header('HTTP/1.1 201 FormList Accessed');
        self::headers();
        echo FormsList::toXML();
        die;
    }

    public static function manifest()
    {
        header('HTTP/1.1 201 Manifest Accessed');
        self::headers();
        echo Manifest::toXML();
        die;
    }

    public static function ODKForm()
    {
        header('HTTP/1.1 201 Form Accessed');
        self::headers();
        echo ODKForm::toXML();
        die;
    }

    public static function formReceived($msg = 'Thanks for submitting!')
    {
        header('HTTP/1.1 201 Form Received');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function accepted($msg = 'We got and saved your data, but may not have fully processed it. You should not try to resubmit.')
    {
        header('HTTP/1.1 201 Input Accepted');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function noContent($msg = 'We are OK!')
    {
        header('HTTP/1.1 204 No Content');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function unauthorized($msg = 'Client tried to post something it didn\'t have permission to post!')
    {
        header('HTTP/1.1 401 Unauthorized');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function forbidden($msg = 'You\'re not allowed to post to this server!')
    {
        header('HTTP/1.1 403 Forbidden');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function notFound($msg = 'Unknown request!')
    {
        header('HTTP/1.1 404 Not Found');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function requestLarge($msg = 'The request body is too large for the server to process!')
    {
        header('HTTP/1.1 413 Max submission exceeded!');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function badRequest($msg = 'Bad Request!')
    {
        header('HTTP/1.1 400 Bad request method');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function invalidEntry($msg = 'Invalid submission!')
    {
        header('HTTP/1.1 406 Invalid Entry');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    public static function internalServerError($msg = 'Something went awry on the server and we\'re not sure what it was!')
    {
        header('HTTP/1.1 500 Internal Server');
        self::messageDOM($msg);
        echo self::getDomDocument()->saveXML();
        die;
    }

    protected static function headers()
    {
        header('X-OpenRosa-Version:1.0');
        header('Content-Type:text/xml;charset=utf-8');
    }

    protected static function submissionHeaders()
    {
        header('X-OpenRosa-Accept-Content-Length: '.Helper::byteconvert(ini_get('post_max_size')));
    }

    public static function isHeadRequest()
    {
        return 0 === strcasecmp($_SERVER['REQUEST_METHOD'], 'head');
    }

    public static function isPostRequest()
    {
        return 0 === strcasecmp($_SERVER['REQUEST_METHOD'], 'post');
    }
}