<?php
/**
 * Created for Angujo-OpenRosaPhp.
 * User: Angujo Barrack
 * Date: 2018-07-17
 * Time: 7:00 PM
 */

namespace Angujo\OpenRosaPhp\Authentication;


//TODO Work on this

/**
 * Class Digest2617
 * @package Angujo\OpenRosaPhp\Authentication
 */
class Digest2617 extends Digest
{
    protected $cnonce;
    protected $qop;
    protected $body;
    protected $nc;

    /**
     * @return mixed
     */
    public function getCnonce()
    {
        return $this->cnonce;
    }

    /**
     * @param mixed $cnonce
     * @return Digest2617
     */
    public function setCnonce($cnonce)
    {
        $this->cnonce = $cnonce;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQop()
    {
        return $this->qop;
    }

    /**
     * @param mixed $qop
     * @return Digest2617
     */
    public function setQop($qop)
    {
        $this->qop = $qop;
        return $this;
    }

    protected function getNc()
    {
        return $this->nc;
    }

    /**
     * @param mixed $body
     * @return Digest2617
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    protected function getHA2()
    {
        if (0 === strcmp($this->qop, 'auth-int')) {
            return md5("$this->request_method:{$this->uri}:" . md5($this->body));
        }
        return parent::getHA2();
    }

    /*public function getResponse()
    {
        if (in_array($this->qop, ['auth', 'auth-int'], false)) {
            return md5($this->getHA1() . ':' . $this->getNonce() . ':' . $this->getNc() . ':' . $this->getCnonce() . ':' . $this->getQop() . ':' . $this->getHA2());
        }
        return parent::getResponse();
    }*/
}