<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-09
 * Time: 1:05 PM
 */

namespace Angujo\OpenRosaPhp;


use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Ns;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Elements\MediaFile;

class Manifest extends Tag
{
    /** @var Manifest */
    private static $me;

    public function __construct() { parent::__construct(Elmt::MANIFEST); }

    public static function create()
    {
        return self::$me = self::$me ?: new self();
    }

    /**
     * @param string|MediaFile $mediaFile
     * @return Tag|MediaFile
     * @throws \InvalidArgumentException
     */
    public function addMediaFile($mediaFile)
    {
        if (\is_object($mediaFile)) {
            return $this->setTag($mediaFile);
        }
        return $this->setTag(MediaFile::create($mediaFile));
    }

    public function XMLify($w = null)
    {
        return $w;
    }

    public function asXML()
    {
        /** @var \XMLWriter $writer */
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement($this->getName());

        $writer->writeAttribute('xmlns', Ns::XFORMSMANIFEST);
        foreach ($this->tags as $tag) {
            $tag->XMLify($writer);
        }
        $writer->endElement();
        $writer->endDocument();
        return $writer->outputMemory();
    }
}