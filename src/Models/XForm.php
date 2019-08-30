<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;

/**
 * Class XForm
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class XForm extends XMLTag
{
    private $form_id;
    private $name;
    private $version;
    private $hash;
    private $description_text;
    private $download_url;
    private $manifest_url;

    public function __construct($id)
    {
        parent::__construct('xform');
        $this->setFormId($id);
    }

    /**
     * @param mixed $form_id
     *
     * @return XForm
     */
    public function setFormId(string $form_id)
    {
        $this->form_id = $form_id;
        $this->setGetElement('formID', $form_id);
        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return XForm
     */
    public function setName(string $name)
    {
        $this->name = $name;
        $this->setGetElement('name', $name);
        return $this;
    }

    /**
     * @param mixed $version
     *
     * @return XForm
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
        $this->setGetElement('version', $version);
        return $this;
    }

    /**
     * @param mixed $hash
     *
     * @return XForm
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;
        $this->setGetElement('hash', $hash);
        return $this;
    }

    /**
     * @param mixed $description_text
     *
     * @return XForm
     */
    public function setDescriptionText(string $description_text)
    {
        $this->description_text = $description_text;
        $this->setGetElement('descriptionText', $description_text);
        return $this;
    }

    /**
     * @param mixed $download_url
     *
     * @return XForm
     */
    public function setDownloadUrl(string $download_url)
    {
        $this->download_url = $download_url;
        $this->setGetElement('downloadUrl', $download_url);
        return $this;
    }

    /**
     * @param mixed $manifest_url
     *
     * @return XForm
     */
    public function setManifestUrl(string $manifest_url)
    {
        $this->manifest_url = $manifest_url;
        $this->setGetElement('manifestUrl', $manifest_url);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormId()
    {
        return $this->form_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return mixed
     */
    public function getDescriptionText()
    {
        return $this->description_text;
    }

    /**
     * @return mixed
     */
    public function getDownloadUrl()
    {
        return $this->download_url;
    }

    /**
     * @return mixed
     */
    public function getManifestUrl()
    {
        return $this->manifest_url;
    }
}