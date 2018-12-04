<?php
/**
 * Created for Angujo-OpenRosaPhp.
 * User: Angujo Barrack
 * Date: 2018-07-17
 * Time: 6:41 PM
 */

namespace Angujo\OpenRosaPhp\Authentication;


class Digest extends Basic
{
    use TraitAuth;

    protected $nonce;
    protected $opaque;
    protected $realm;
    protected $uri;
    protected $response;

    private $ha1;

    /**
     * @param mixed $response
     * @return Digest
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param mixed $nonce
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
    }

    /**
     * @return mixed
     */
    public function getOpaque()
    {
        return $this->opaque;
    }

    /**
     * @param mixed $opaque
     */
    public function setOpaque($opaque)
    {
        $this->opaque = $opaque;
    }

    /**
     * @return mixed
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * @param mixed $realm
     */
    public function setRealm($realm)
    {
        $this->realm = $realm;
    }

    /**
     * @return mixed
     */
    protected function getA1()
    {
        if (!$this->password) return null;
        return "$this->username:$this->realm:$this->password";
    }

    /**
     * @return mixed
     */
    protected function getA2()
    {
        return "$this->request_method:$this->uri";
    }

    protected function getHA1()
    {
        if ($this->ha1) return $this->ha1;
        if (!($a1 = $this->getA1())) return null;
        return md5($a1);
    }

    /**
     * @param mixed $ha1
     * @return Digest
     */
    public function setHa1($ha1)
    {
        $this->ha1 = $ha1;
        return $this;
    }

    protected function genPassWH1($password)
    {
        return md5("$this->username:$this->realm:$password");
    }

    protected function getHA2()
    {
        if (!($a2 = $this->getA2())) return null;
        return md5($a2);
    }

    /**
     * @param mixed $uri
     * @return Digest
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response ?: md5($this->getHA1() . ':' . $this->getNonce() . ':' . $this->getHA2());
    }
}