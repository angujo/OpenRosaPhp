<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;

/**
 * Class XFormsGroup
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class XFormsGroup extends XMLTag
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $list_url;
    /** @var string */
    private $description_text;
    /** @var string */
    private $description_url;

    public function __construct($id)
    {
        parent::__construct('xforms-group');
        $this->setId($id);
    }

    /**
     * @param string $id
     *
     * @return XFormsGroup
     */
    public function setId(string $id): XFormsGroup
    {
        $this->id = $id;
        $this->setGetElement('groupID', $id);
        return $this;
    }

    /**
     * @param string $name
     *
     * @return XFormsGroup
     */
    public function setName(string $name): XFormsGroup
    {
        $this->name = $name;
        $this->setGetElement('name', $name);
        return $this;
    }

    /**
     * @param string $list_url
     *
     * @return XFormsGroup
     */
    public function setListUrl(string $list_url): XFormsGroup
    {
        $this->list_url = $list_url;
        $this->setGetElement('listUrl', $list_url);
        return $this;
    }

    /**
     * @param string $description_text
     *
     * @return XFormsGroup
     */
    public function setDescriptionText(string $description_text): XFormsGroup
    {
        $this->description_text = $description_text;
        $this->setGetElement('descriptionText', $description_text);
        return $this;
    }

    /**
     * @param string $description_url
     *
     * @return XFormsGroup
     */
    public function setDescriptionUrl(string $description_url): XFormsGroup
    {
        $this->description_url = $description_url;
        $this->setGetElement('descriptionUrl', $description_url);
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getListUrl(): string
    {
        return $this->list_url;
    }

    /**
     * @return string
     */
    public function getDescriptionText(): string
    {
        return $this->description_text;
    }

    /**
     * @return string
     */
    public function getDescriptionUrl(): string
    {
        return $this->description_url;
    }

}