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
        $tag->parentPath($this->getXpath());
        $this->setTag($tag);
        return $tag;
    }

    /**
     * @param $name
     * @return Tag|Group
     */
    public function group($name)
    {
        return $this->addElement(Group::create($name));
    }

    /**
     * @param $name
     * @return Tag|Repeat
     */
    public function repeat($name)
    {
        $gr = $this->addElement(Repeat::create($name));
        return $gr->getUniqueTag(Elmt::REPEAT);
    }

    /**
     * @param $name
     * @return InputText|Tag
     */
    public function inputText($name)
    {
        return $this->addElement(InputText::text($name));
    }

    /**
     * @param $name
     * @return InputText|Tag
     */
    public function inputMultiline($name)
    {
        return $this->addElement(InputText::multiline($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadImage($name)
    {
        return $this->addElement(Upload::image($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadVideo($name)
    {
        return $this->addElement(Upload::video($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadAudio($name)
    {
        return $this->addElement(Upload::audio($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function uploadFile($name)
    {
        return $this->addElement(Upload::file($name));
    }

    /**
     * @param $name
     * @return Tag|Upload
     */
    public function barcode($name)
    {
        return $this->addElement(Upload::barcode($name));
    }

    /**
     * @param $name
     * @param array $mimes
     * @return Tag|Upload
     */
    public function uploadCustom($name, array $mimes)
    {
        return $this->addElement(Upload::custom($name, $mimes));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateYearMonth($name)
    {
        return $this->addElement(InputDateTime::yearMonth($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateYear($name)
    {
        return $this->addElement(InputDateTime::year($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function dateFull($name)
    {
        return $this->addElement(InputDateTime::fullDate($name));
    }

    /**
     * @param $name
     * @return Tag|InputDateTime
     */
    public function time($name)
    {
        return $this->addElement(InputDateTime::time($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOne($name)
    {
        return $this->addElement(Select1::create($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOneLikert($name)
    {
        return $this->addElement(Select1::likert($name));
    }

    /**
     * @param $name
     * @return Tag|Select1
     */
    public function selectOneQuick($name)
    {
        return $this->addElement(Select1::quick($name));
    }

    /**
     * @param $name
     * @return Tag|Select
     */
    public function selectMultiple($name)
    {
        return $this->addElement(Select::create($name));
    }
}