<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 8:15 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Controls\InputDateTime;
use Angujo\OpenRosaPhp\Models\Controls\InputText;
use Angujo\OpenRosaPhp\Models\Controls\Select;
use Angujo\OpenRosaPhp\Models\Controls\Select1;
use Angujo\OpenRosaPhp\Models\Controls\Upload;

class ControlHolder extends BodyElement
{

    public function addElement(BodyElement $tag)
    {
        return $this->silenceElement($tag);
    }

    private function silenceElement(BodyElement $element)
    {
        $element->parentPath($this->getXpath());
        $this->setTag($element);
        $element->register();
        return $element;
    }

    /**
     * @param $name
     * @return Tag|Group
     */
    public function group($name)
    {
        return $this->silenceElement(Group::create($name));
    }

    /**
     * @param $name
     * @return Tag|Repeat
     */
    public function repeat($name)
    {
        $gr = $this->silenceElement(Repeat::create($name));
        return $gr->getUniqueTag(Elmt::REPEAT);
    }

    /**
     * @param $name
     * @return InputText|Tag
     */
    public function inputText($name)
    {
        return $this->silenceElement(InputText::text($name));
    }

    /**
     * @param $name
     * @return InputText|Tag
     */
    public function inputMultiline($name)
    {
        return $this->silenceElement(InputText::multiline($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadImage($name)
    {
        return $this->silenceElement(Upload::image($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadVideo($name)
    {
        return $this->silenceElement(Upload::video($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadAudio($name)
    {
        return $this->silenceElement(Upload::audio($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadFile($name)
    {
        return $this->silenceElement(Upload::file($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function barcode($name)
    {
        return $this->silenceElement(Upload::barcode($name));
    }

    /**
     * @param $name
     * @param array $mimes
     * @return Tag|Upload
     */
    public function uploadCustom($name, array $mimes)
    {
        return $this->silenceElement(Upload::custom($name, $mimes));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateYearMonth($name)
    {
        return $this->silenceElement(InputDateTime::yearMonth($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateYear($name)
    {
        return $this->silenceElement(InputDateTime::year($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateFull($name)
    {
        return $this->silenceElement(InputDateTime::fullDate($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function time($name)
    {
        return $this->silenceElement(InputDateTime::time($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOne($name)
    {
        return $this->silenceElement(Select1::create($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOneLikert($name)
    {
        return $this->silenceElement(Select1::likert($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOneQuick($name)
    {
        return $this->silenceElement(Select1::quick($name));
    }

    /**
     * @param $name
     * @return Tag|Select
     */
    public function selectMultiple($name)
    {
        return $this->silenceElement(Select::create($name));
    }
}