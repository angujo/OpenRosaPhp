<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 12:45 PM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class MediaFile extends Tag
{
    /** @var MediaFile */
    private static $me;

    /**
     * MediaFile constructor.
     * @param $url
     * @throws \InvalidArgumentException
     */
    protected function __construct($url)
    {
        parent::__construct(Elmt::MEDIAFILE, null);
        $this->set($url);
    }

    /**
     * @param $url
     * @throws \InvalidArgumentException
     */
    private function set($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) throw new \InvalidArgumentException('Invalid media url!');
        $parsed = parse_url($url);
        $fileName = empty($parsed['path']) ? uniqid('fp', false) : basename($parsed['path']);
        $this->fileName($fileName)->hash('md5:' . md5($url))->downloadUrl($url);
    }

    /**
     * @param $url
     * @return MediaFile
     * @throws \InvalidArgumentException
     */
    public static function create($url)
    {
        return self::$me = self::$me ?: new self($url);
    }

    public function fileName($name)
    {
        $this->addUniqueTag('filename', $name);
        return $this;
    }

    public function hash($hash)
    {
        $this->addUniqueTag('hash', $hash);
        return $this;
    }

    public function downloadUrl($url)
    {
        $this->addUniqueTag('downloadUrl', $url);
        return $this;
    }
}