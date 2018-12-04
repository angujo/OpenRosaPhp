<?php

namespace Angujo\OpenRosaPhp\Forms;

use Angujo\OpenRosaPhp\Libraries\Elmt;


/**
 * XForm
 * @authors bangujo (@angujomondi)
 * @date    2018-12-04 14:51:27
 * @version 1.0.0
 */

class XForm extends FormHolder
{

    protected function __construct($id, $name)
    {
        parent::__construct(Elmt::XFORM,null);
        $this->setID($id)->setName($name);
    }

    public static function create($id, $name)
    {
        return new self($id, $name);
    }

    public function setID($id)
    {
        $this->addUniqueTag('formID', $id);
        return $this;
    }

    public function setName($name)
    {
        $this->addUniqueTag('name', $name);
        return $this;
    }

    public function setDownloadUrl($url)
    {
        $this->addUniqueTag('downloadUrl', $url);
        return $this;
    }

    public function setVersion($version)
    {
        $this->addUniqueTag('version', $version);
        return $this;
    }

    public function setHash($hash)
    {
        $this->addUniqueTag('hash', $hash);
        return $this;
    }

    public function setManifestUrl($url)
    {
        $this->addUniqueTag('manifestUrl', $url);
        return $this;
    }
}
