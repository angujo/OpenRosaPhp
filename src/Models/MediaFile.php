<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;

/**
 * Class MediaFile
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class MediaFile extends XMLTag
{
    /** @var string */
    private $filename;
    /** @var string */
    private $hash;
    /** @var string */
    private $download_url;

    public function __construct($file_name){ parent::__construct('mediaFile'); }

    /**
     * @param mixed $filename
     *
     * @return MediaFile
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        $this->setGetElement('filename', $filename);
        return $this;
    }

    /**
     * @param mixed $hash
     *
     * @return MediaFile
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        $this->setGetElement('hash', $hash);
        return $this;
    }

    /**
     * @param mixed $download_url
     *
     * @return MediaFile
     */
    public function setDownloadUrl($download_url)
    {
        $this->download_url = $download_url;
        $this->setGetElement('downloadUrl', $download_url);
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getDownloadUrl(): string
    {
        return $this->download_url;
    }

}