<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 3:40 AM
 */

namespace Angujo\OpenRosaPhp\Utils;


use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Response;

class Helper
{
    public static function validateTagName($name)
    {
        if (!preg_match('/^([a-z_]([a-z0-9\-_]+)?[a-z0-9])$/i', $name)) {
            throw new OException($name.' is Invalid attribute/tag name!');
        }
    }

    public static function toVariableName($name)
    {
        return (string)preg_replace('/[^a-z0-9]/i', '-', strtolower($name));
    }

    public static function array_dot(&$arr, $path, $value, $separator = '.')
    {
        $keys = explode($separator, $path);

        foreach ($keys as $key) {
            $arr = &$arr[$key];
        }
        $arr = $value;
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function xmlName($name)
    {
        if (null === $name) {
            return null;
        }
        if (!\is_string($name) || !trim($name) || 1 !== preg_match('/([a-zA-Z])/', $name)) {
            throw new \InvalidArgumentException("$name is an invalid name!");
        }
        return trim(preg_replace(['/^([^a-z]+)/i', '/([^a-z0-9_]+)/i'], '_', $name), ' _');
    }

    public static function byteconvert($input)
    {
        preg_match('/(\d+)(\w+)/i', $input, $matches);
        $type   = strtolower($matches[2]);
        $output = 0;
        switch ($type) {
            case 'b':
                $output = $matches[1];
                break;
            case 'k':
            case 'kb':
                $output = $matches[1] * 1024;
                break;
            case 'm':
            case 'mb':
                $output = $matches[1] * 1024 * 1024;
                break;
            case 'g':
            case 'gb':
                $output = $matches[1] * 1024 * 1024 * 1024;
                break;
            case 't':
            case 'tb':
                $output = $matches[1] * 1024 * 1024 * 1024 * 1024;
                break;
        }
        return $output;
    }

    /**
     *
     * @param \SimpleXMLElement $xml
     * @param array             $options
     *
     * @return array
     * @see    https://outlandish.com/blog/tutorial/xml-to-json/
     *
     *
     * @author Tamlyn Rhodes 2012-08-23
     */
    public static function xmlToArray($xml, $options = [])
    {
        $defaults       = [
            'namespaceSeparator' => ':',//you may want this to be something other than a colon
            'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
            'alwaysArray' => [],   //array of xml tag names which should always become arrays
            'autoArray' => true,        //only create arrays for tags which appear more than once
            'textContent' => '$',       //key used for the text content of elements
            'autoText' => true,         //skip textContent key if node has no attributes or child nodes
            'keySearch' => false,       //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        ];
        $options        = array_merge($defaults, $options);
        $namespaces     = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace

        //get attributes from all namespaces
        $attributesArray = [];
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) {
                    $attributeName =
                        str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                }
                $attributeKey                   = $options['attributePrefix']
                    .($prefix ? $prefix.$options['namespaceSeparator'] : '')
                    .$attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }

        //get child nodes from all namespaces
        $tagsArray = [];
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = self::xmlToArray($childXml, $options);
                //list($childTagName, $childProperties) = each($childArray);
                $childTagName    = key($childArray);
                $childProperties = current($childArray);

                //replace characters in tag name
                if ($options['keySearch']) {
                    $childTagName =
                        str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                }
                //add namespace prefix, if any
                if ($prefix) {
                    $childTagName = $prefix.$options['namespaceSeparator'].$childTagName;
                }

                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? [$childProperties] : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = [$tagsArray[$childTagName], $childProperties];
                }
            }
        }

        //get text content of node
        $textContentArray = [];
        $plainText        = trim((string)$xml);
        if ($plainText !== '') {
            $textContentArray[$options['textContent']] = $plainText;
        }

        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

        //return node as array
        return [
            $xml->getName() => $propertiesArray,
        ];
    }

    public static function camelCaseToUnderscore($input)
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $input));
    }

    public static function validDate($text)
    {
        $format = 'Y-m-d';
        return ($d = \DateTime::createFromFormat($format, $text)) && $d->format($format) == $text;
    }

    public static function validDateTime($text)
    {
        $format  = 'Y-m-d H:i';
        $format2 = 'Y-m-d H:i:s';
        return (($d = \DateTime::createFromFormat($format, $text)) && $d->format($format) == $text) || (($d2 = \DateTime::createFromFormat($format2, $text)) && $d2->format($format2) == $text);
    }

    public static function validTime($text)
    {
        $format  = 'H:i';
        $format2 = 'H:i:s';
        return (($d = \DateTime::createFromFormat($format, $text)) && $d->format($format) == $text) || (($d2 = \DateTime::createFromFormat($format2, $text)) && $d2->format($format2) == $text);
    }

    public static function fileContent($file_name)
    {
        if (empty($_FILES[$file_name])) {
            Response::invalidEntry('No Submission!');
        }
        $content = file_get_contents($_FILES[$file_name]['tmp_name']);
        if (self::inValidXML($content)) {
            Response::invalidEntry('Invalid XML Submission!');
        }
        return $content;
    }

    protected static function inValidXML($content)
    {
        libxml_use_internal_errors(true);
        return !simplexml_load_string($content);
    }
}