<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Utils\Helper;

/**
 * Class FileSubmission
 *
 * @package Angujo\OpenRosaPhp\Core
 */
class FileSubmission
{
    private $file_content;
    private $file_data = [];

    /**
     * FileSubmission constructor.
     *
     * @param $content
     *
     * @throws \Exception
     */
    protected function __construct($content)
    {
        $this->file_content = $content;
        libxml_use_internal_errors(true);
        $simple = simplexml_load_string(preg_replace('/(\n+(\s+)?)/', '', $this->file_content));
        if (false === $simple) {
            $errors = libxml_get_errors();
            /** @var \LibXMLError $error */
            $error = array_pop($errors);
            libxml_use_internal_errors(false);
            throw new \Exception("{$error->level}: {$error->message}", $error->code);
        }
        $simple          = json_decode(json_encode($simple));
        $simple          = $this->breakObject($simple);
        $this->file_data = $simple;
    }

    /**
     * @param $object
     *
     * @return array
     */
    private function breakObject($object)
    {
        if (is_array($object)) {
            return array_map([$this, 'breakObject'], $object);
        }
        if (!is_object($object)) {
            return $object;
        }
        return array_map(function($property){ return $this->breakObject($property); }, get_object_vars($object));
    }

    /**
     * @param string $name
     *
     * @return FileSubmission
     * @throws \Exception
     */
    public static function fromFILE($name = 'xml_submission_file')
    {
        return new self(Helper::fileContent($name));
    }

    /**
     * @param string $content
     *
     * @return FileSubmission
     * @throws \Exception
     */
    public static function fromContent(string $content)
    {
        return new self($content);
    }
}