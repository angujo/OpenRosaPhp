<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 7:19 PM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;

use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class Submission extends Tag
{

    private const POST = 'POST';
    private const GET = 'GET';

    private $encryption;
    private $url;

    /** @var Submission */
    private static $me;

    protected function __construct($url, $encryption = null)
    {
        parent::__construct(Elmt::SUBMISSION, null);
        $this->addAttribute('action', $url);
        $this->addAttribute('method', 'post');
        $this->setEncryption($encryption);
    }

    public static function post($url,$encryption_key=null)
    {
        return self::$me=self::$me?:new self($url,$encryption_key);
    }

    /**
     * Get the value of encryption
     */
    public function getEncryption()
    {
        return $this->encryption;
    }

    /**
     * Set the value of encryption
     *
     * @return  self
     */
    public function setEncryption($encryption)
    {
        if (\is_string($encryption) && ($encryption = trim($encryption))) {
            $this->addAttribute('base64RsaPublicKey', $encryption);
            $this->encryption = $encryption;
        }

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function autoSend($confirm=true)
    {
        $confirm=var_export((bool)$confirm,true);
         $this->addNSAttribute('orx','auto-send',$confirm);
        return $this;
    }

    public function autoDelete($confirm=true)
    {
        $confirm=var_export((bool)$confirm,true);
         $this->addNSAttribute('orx','auto-delete',$confirm);
        return $this;
    }
}
