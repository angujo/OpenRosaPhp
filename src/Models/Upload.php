<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\ControlElement;

class Upload extends ControlElement
{
    public function __construct($name){ parent::__construct('upload', $name); }

    public static function Image($name)
    {
        return (new self($name))->setMedia('image/*');
    }

    public static function ImageNew($name)
    {
        return (new self($name))->setMedia('image/*')->setAppearance('new');
    }

    public static function ImageSelfie($name)
    {
        return (new self($name))->setMedia('image/*')->setAppearance('new-front');
    }

    public static function Annotation($name)
    {
        return (new self($name))->setMedia('image/*')->setAppearance('annotate');
    }

    public static function Drawing($name)
    {
        return (new self($name))->setMedia('image/*')->setAppearance('draw');
    }

    public static function Signature($name)
    {
        return (new self($name))->setMedia('image/*')->setAppearance('signature');
    }

    public static function Audio($name)
    {
        return (new self($name))->setMedia('audio/*');
    }

    public static function Video($name)
    {
        return (new self($name))->setMedia('video/*');
    }

    public static function VideoSelfie($name)
    {
        return (new self($name))->setMedia('video/*')->setAppearance('new-front');
    }

    private function setMedia($type)
    {
        return $this->addAttribute('mediatype', $type);
    }

    private function setAppearance($appear)
    {
        return $this->addAttribute('appearance', $appear);
    }
}