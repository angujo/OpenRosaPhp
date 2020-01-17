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
    use CanBeBound;

    public function __construct()
    {
        parent::__construct('meta');
    }

    public function instanceID()
    {
        $this->addElementUnq('instanceID');
        if (Config::isODK()) {
            ODKForm::head()->getModel()->addBind((new Bind())->setCalculation("concat('uuid:', uuid())")->setReadOnly()->setType('string'));
        }
        return $this;
    }

    public function timeStart()
    {
        $this->addElementUnq('timestart');
        $this->setBind('timestamp', 'start', 'dateTime');
        return $this;
    }

    public function timeEnd()
    {
        $this->addElementUnq('timeend');
        $this->setBind('timestamp', 'end', 'dateTime');
        return $this;
    }

    public function userID()
    {
        $this->addElementUnq('userid');
        $this->setBind('property', 'username', 'string');
        return $this;
    }

    public function deviceID()
    {
        $this->addElementUnq('deviceid');
        $this->setBind('property', 'deviceid', 'string');
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
        $this->addElementUnq('phonenumber');
        $this->setBind('property', 'phonenumber', 'string');
        return $this;
    }

    public function simSerial()
    {
        $this->addElementUnq('simserial');
        $this->setBind('property', 'simserial', 'string');
        return $this;
    }

    public function subscriberID()
    {
        $this->addElementUnq('subscriberid');
        $this->setBind('property', 'subscriberid', 'string');
        return $this;
    }

    /*public function audit(){
        $this->setBind('timestamp', 'start', 'dateTime');
        return $this; }*/

    private function setBind($preload, $preload_params, $type)
    {
        if (Config::isODK()) {
            ODKForm::head()->getModel()->addBind((new Bind())->setPreload($preload)->setPreloadParams($preload_params)->setType($type));
        }
    }
}