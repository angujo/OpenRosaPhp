<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 6:47 AM
 */

namespace Angujo\OpenRosaPhp\Access;

use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Libraries\Ns;

class Response extends Tag
{
    /** @var bool */
    private $success = true;
    /** @var Response */
    private static $me;

    protected function __construct($message, $success = true)
    {
        parent::__construct(Elmt::OPENROSARESPONSE, null);

        $this->setUniqueTag(Tag::raw(Elmt::MESSAGE, $message));
        $this->success = $success;
        $this->setNature();
    }

    private function setNature()
    {
        $nature = $this->success ? 'submission_success' : 'submission_error';
        $this->getUniqueTag(Elmt::MESSAGE)->setAttribute('nature', $nature);
    }

    /**
     * @return $this
     * */
    protected static function init($msg, $status = true)
    {
        return self::$me = self::$me ?: new self($msg, $status);
    }

    /**
     * @return $this
     * */
    public static function error($message)
    {
        return self::init($message, false);
    }

    /**
     * @return $this
     * */
    public static function success($message)
    {
        return self::init($message, true);
    }

    /**
     * @return string
     */
    public function XMLify($w = null)
    {
        return $w;
    }

    /**
     * @return string
     */
    public function asXML()
    {
        /** @var \XMLWriter $writer */
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement($this->getName());

        $writer->writeAttribute('xmlns', Ns::RESPONSE);
        foreach ($this->tags as $tag) {
            $tag->XMLify($writer);
        }
        $writer->endElement();
        $writer->endDocument();
        return $writer->outputMemory();
    }
}
