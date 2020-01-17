<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2020-01-08
 * Time: 3:10 AM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Config;
use Angujo\OpenRosaPhp\Core\Bind;
use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\ODKForm;
use Angujo\OpenRosaPhp\Support\CanBeBound;

class Meta extends XMLTag
{
    private $_data_path;

    public function __construct(&$path)
    {
        parent::__construct('meta');
        $this->_data_path = $path;
    }

    public function instanceID()
    {
        $name = ('instanceID');
        $this->addElementUnq($name);
        if (Config::isODK()) {
            ODKForm::head()->getModel()->addBind((new Bind())->setNodeSet("/{$this->_data_path}/meta/{$name}")->setCalculation("concat('uuid:', uuid())")->setReadOnly()->setType('string'));
        }
        return $this;
    }

    public function timeStart()
    {
        $name = ('timestart');
        $this->addElementUnq($name);
        $this->setBind($name, 'timestamp', 'start', 'dateTime');
        return $this;
    }

    public function timeEnd()
    {
        $name = ('timeend');
        $this->addElementUnq($name);
        $this->setBind($name, 'timestamp', 'end', 'dateTime');
        return $this;
    }

    public function userID()
    {
        $name = ('userid');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'username', 'string');
        return $this;
    }

    public function deviceID()
    {
        $name = ('deviceid');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'deviceid', 'string');
        return $this;
    }

    /*public function deprecatedID(){
        $this->setBind('timestamp', 'start', 'dateTime');
        return $this; }*/

    /*public function email(){
        $this->setBind('timestamp', 'start', 'dateTime');
        return $this; }*/

    public function phoneNumber()
    {
        $name = ('phonenumber');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'phonenumber', 'string');
        return $this;
    }

    public function simSerial()
    {
        $name = ('simserial');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'simserial', 'string');
        return $this;
    }

    public function subscriberID()
    {
        $name = ('subscriberid');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'subscriberid', 'string');
        return $this;
    }
    public function email()
    {
        $name = ('email');
        $this->addElementUnq($name);
        $this->setBind($name, 'property', 'email', 'string');
        return $this;
    }

    /*public function audit(){
        $this->setBind('timestamp', 'start', 'dateTime');
        return $this; }*/

    private function setBind($name, $preload, $preload_params, $type)
    {
        if (Config::isODK()) {
            ODKForm::head()->getModel()->addBind((new Bind())->setNodeSet("/{$this->_data_path}/meta/{$name}")->setPreload($preload)->setPreloadParams($preload_params)->setType($type));
        }
    }
}