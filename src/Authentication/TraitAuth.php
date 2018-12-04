<?php

/**
 * Created for Angujo-OpenRosaPhp.
 * User: Angujo Barrack
 * Date: 2018-07-17
 * Time: 7:09 PM
 */

namespace Angujo\OpenRosaPhp\Authentication;

trait TraitAuth {

    protected $_password;
    protected $_a1;
    protected static $app_realm;

    /**
     * 
     * @param string $realm
     * @return $this
     */
    public static function setAppRealm($realm) {
        self::$app_realm = $realm;
        return new static;
    }

    public function compileBase64($password) {
        $this->_password=$password;
    }

    public function compileA1($password) {
        $this->_password=$password;
    }

}
