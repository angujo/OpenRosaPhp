<?php

namespace Angujo\OpenRosaPhp\Forms;

use Angujo\OpenRosaPhp\Libraries\Tag;
/**
 * 
 *
 * @authors Your Name (you@example.org)
 * @date    2018-12-04 16:06:38
 * @version 1.0.0
 */
class   FormHolder extends Tag {


    public function setName($name)
    {
        $this->addUniqueTag('name', $name);
        return $this;
    }

    public function setDescriptionUrl($url)
    {
        $this->addUniqueTag('descriptionUrl', $url);
        return $this;
    }

    public function setDescriptionText($text)
    {
        $this->addUniqueTag('descriptionText', $text);
        return $this;
    }

    public function asXML()
    {
        return $this->XMLify();
    }
}