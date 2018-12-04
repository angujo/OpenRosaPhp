<?php

/**
 * Created for Angujo-PhpRosa.
 * User: Angujo Barrack
 * Date: 2018-07-17
 * Time: 7:21 PM
 */

namespace Angujo\OpenRosaPhp\Authentication;

/**
 * Class Access
 * @package Angujo\PhpRosa\Authentication
 *
 * @see https://github.com/phpmasterdotcom/UnderstandingHTTPDigest/blob/master/server.php
 */
class Access
{

    private static $realm = 'AngujoBarrack-PhpRosa:Auth';
    /** @var Basic|Digest|Digest2617 */
    private $client;
    /** @var Basic|Digest|Digest2617 */
    private $server;
    private $nonce;
    private $opaque;

    protected function __construct()
    {
        $this->nonce = md5(uniqid('', true));
        $this->opaque = md5(uniqid('', true));
        $this->setAuthHeader();
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $this->client = new Basic(['username' => $_SERVER['PHP_AUTH_USER'], 'password' => $_SERVER['PHP_AUTH_PW']]);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $this->client = $this->http_digest_parse($_SERVER['PHP_AUTH_DIGEST']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->client = $this->httpAuthorization();
        }
        if (null === $this->client || (!is_subclass_of($this->client, Basic::class) && !is_a($this->client, Basic::class))) {
            $this->authFailed('Authorization identification missing!');
        }

        $this->server = clone $this->client;
        $this->server->setPassword(null);
        if (is_a($this->server, Digest::class)) {
            $this->server->setResponse(null);
            $this->server->setRealm(self::$realm);
        }
    }

    /**
     * This should be used when authentication directive is MD5 or unspecified
     * @param $username
     * @param $password
     * @return string
     */
    public static function ha1_2069($username, $password)
    {
        return md5($username . ':' . self::$realm . ':' . $password);
    }

    /**
     * This should be used when algorithm directive is MD5-Sess
     * @param $username
     * @param $password
     * @param $nonce
     * @param $cnonce
     * @return string
     */
    public static function ha1_2617($username, $password, $nonce, $cnonce)
    {
        return md5(self::ha1_2069($username, $password) . ':' . $nonce . ':' . $cnonce);
    }

    public function setAuthHeader()
    {
        header(sprintf('WWW-Authenticate: Digest realm="%s", nonce="%s", opaque="%s"', self::$realm, $this->nonce, $this->opaque));
    }

    /**
     * @return string
     */
    public static function getRealm()
    {
        return self::$realm;
    }

    public function getUsername()
    {
        return $this->client ? $this->client->getUsername() : null;
    }

    public static function setRealm($realm)
    {
        self::$realm = $realm;
    }

    public static function authenticateByPassword(\Closure $closure)
    {
        $me = new self();
        if (!is_callable($closure)) $me->authFailed('Server Error!');
        $password = $closure($me->client->getUsername());
        if (null === $password || !is_string($password)) $me->authFailed('Missing credentials!');
        $me->server->setPassword($password);
        if (!is_a($me->server, Basic::class)) $me->authFailed('Invalid Access Authentication!');
        if ((is_a($me->server, Digest::class) && 0 !== strcasecmp($me->server->getResponse(), $me->client->getResponse())) ||
            (0 === strcasecmp(get_class($me->server), Basic::class) && 0 !== strcasecmp($me->server->getPassword(), $me->client->getPassword()))) {
            $me->authFailed('Invalid Username/Password credentials!');
        }
        header('HTTP/1.1 200 OK');
    }

    public static function authenticateByHA1(\Closure $closure)
    {
        $me = new self();
        if (!is_callable($closure)) $me->authFailed('Server Error!');
        $ha1 = $closure($me->client->getUsername());
        if (null === $ha1 || !is_string($ha1)) $me->authFailed('Missing permissions!');
        if (!is_a($me->server, Digest::class) && !is_subclass_of($me->server, Digest::class)) {
            $me->authFailed('Basic Access not permitted!');
        }
        $me->server->setHa1($ha1);
        if (0 !== strcasecmp($me->client->getResponse(), $me->server->getResponse())) $me->authFailed('Invalid Hash credentials!');

        header('HTTP/1.1 200 OK');
    }

    private function httpAuthorization()
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) return null;
        if (stripos($_SERVER['HTTP_AUTHORIZATION'], 'basic') === 0) {
            list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
            $basic = new Basic();
            $basic->setPassword($password);
            $basic->setUsername($username);
            return $basic;
        }
        return $this->http_digest_parse(substr($_SERVER['HTTP_AUTHORIZATION'], 8));
    }

    /**
     * @param string|array $txt
     * @return Digest|Digest2617|null
     *
     * @see http://php.net/manual/en/features.http-auth.php
     */
    protected function http_digest_parse($txt)
    {
        // protect against missing data
        $needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1,
            'qop' => 1, 'username' => 1, 'uri' => 1,
            'response' => 1, 'opaque' => 1, 'realm' => 1);
        $data = array();
        $keys = implode('|', array_keys($needed_parts));

        preg_match_all('@(' . $keys . ')=(?:(["])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

        foreach ($matches as $m) {
            $data[$m[1]] = $m[3] ? $m[3] : $m[4];
            unset($needed_parts[$m[1]]);
        }

        if (($needed_parts && 3 === count(array_diff(['nc', 'cnonce', 'qop'], array_keys($data)))) || (isset($data['qop']) && 0 === strcmp($data['qop'], 'auth'))) {
            return new Digest($data);
        }

        return $needed_parts ? null : new Digest2617($data);
    }

    public function authFailed($message)
    {
        header('HTTP/1.1 401 Unauthorized');
        header('Content-Type: text/html');
        echo $message;
        exit();
    }

}
