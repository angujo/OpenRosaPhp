<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Models\Group;
use Angujo\OpenRosaPhp\Models\Input;
use Angujo\OpenRosaPhp\Models\Range;
use Angujo\OpenRosaPhp\Models\Repeat;
use Angujo\OpenRosaPhp\Models\Select;
use Angujo\OpenRosaPhp\Models\Select1;
use Angujo\OpenRosaPhp\Models\Upload;
use ReflectionException;

/**
 * Class InterfaceElement
 *
 * @package Angujo\OpenRosaPhp\Core
 *
 * @method Input InputText($name)
 * @method Input InputNumberInteger($name)
 * @method Input InputNumberDecimal($name)
 * @method Input InputBooleanType($name)
 * @method Input InputDateType($name)
 * @method Input InputTimeType($name)
 * @method Input InputDateTime($name)
 * @method Input InputBarcode($name)
 * @method Upload UploadImage($name)
 * @method Upload UploadImageNew($name)
 * @method Upload UploadImageSelfie($name)
 * @method Upload UploadAnnotation($name)
 * @method Upload UploadDrawing($name)
 * @method Upload UploadSignature($name)
 * @method Upload UploadAudio($name)
 * @method Upload UploadVideo($name)
 * @method Upload UploadVideoSelfie($name)
 * @method Range Range($name, int $starts, float $ends, float $step)
 * @method Group Group($name = null)
 * @method Repeat Repeat($name = null)
 * @method Select Select($name)
 * @method Select1 Select1($name)
 */
class InterfaceElement extends XMLTag
{
    protected $name;
    protected $nodeset = [];

    /**
     * @param $name
     * @param $args
     *
     * @return mixed|object|XMLTag
     * @throws OException
     * @throws ReflectionException
     */
    public function __call($name, $args)
    {
        $fp = '/^([A-Z]([a-z]+))/';
        if (!preg_match($fp, $name, $output_array)) {
            throw new OException('Invalid body element::'.$name);
        }
        $className = 'Angujo\OpenRosaPhp\Models\\'.$output_array[0];
        $method    = preg_replace($fp, '', $name);
        if (!class_exists($className)) {
            throw new OException('The element identifier '.$className.' is missing!');
        }
        if ($method && !method_exists($className, $method)) {
            throw new OException('The element control '.$className.'::'.$method.' is missing!');
        }

        if (!$method) {
            $rclass  = new \ReflectionClass($className);
            $element = $rclass->newInstanceArgs($args);
        } else {
            $element = call_user_func_array([$className, $method], $args);
        }
        if (!is_a($element, XMLTag::class)) {
            throw new OException('Invalid element!');
        }
        $this->addElement($element);
        return $element;
    }
}