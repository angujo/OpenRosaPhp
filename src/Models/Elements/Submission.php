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
    
    private const POST = 'post';
    private const GET  = 'GET';
    
    private $encryption;
    private $url;
    
    /** @var Submission */
    private static $me;
    
    protected function __construct($url, $encryption = NULL)
    {
        parent::__construct(Elmt::SUBMISSION, NULL);
        $this->addAttribute('action', $url);
        $this->addAttribute('method', 'post');
        $this->setEncryption($encryption);
    }
    
    public static function post($url, $encryption_key = NULL)
    {
        return self::$me = (self::$me ?: new self($url, $encryption_key))->setMethod(self::POST);
    }
    
    private function setMethod($method)
    {
        $this->addAttribute('method', $method);
        return $this;
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
    
    public function autoSend($confirm = TRUE)
    {
        $confirm = var_export((bool)$confirm, TRUE);
        $this->addNSAttribute('orx', 'auto-send', $confirm);
        return $this;
    }
    
    public function autoDelete($confirm = TRUE)
    {
        $confirm = var_export((bool)$confirm, TRUE);
        $this->addNSAttribute('orx', 'auto-delete', $confirm);
        return $this;
    }
}
