<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 3:40 PM
 */

namespace Angujo\OpenRosaPhp\Models\Head;


use Angujo\OpenRosaPhp\Libraries\Binds;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;
use Angujo\OpenRosaPhp\Models\Config;
use Angujo\OpenRosaPhp\Models\Elements\Bind;


/**
 * Class Meta
 * @package Angujo\OpenRosaPhp\Models\Head
 */
class Meta extends Tag
{

    /** @var Meta Only me */
    private static $me;
    private        $root    = 'root';
    private        $allowed = ['instanceID', 'timeStart', 'timeEnd', 'userID', 'deviceID', 'deprecatedID', 'email', 'phoneNumber', 'simSerial', 'subscriberID', 'audit',];

    protected function __construct($root)
    {
        parent::__construct(Elmt::META, null);
        $this->root = $root;
        $this->instanceID();
    }

    public static function create($root)
    {
        return self::$me = self::$me ?: new self($root);
    }

    private function instanceID()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'readonly' => "true()", 'calculate' => "concat('uuid:', uuid())"]);
        return $this;
    }

    public function timeStart()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "dateTime", 'preload' => ['jr', "timestamp"], 'preloadParams' => ['jr', "start"]]);
        return $this;
    }

    public function timeEnd()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "dateTime", 'preload' => ['jr', "timestamp"], 'preloadParams' => ['jr', "end"]]);
        return $this;
    }

    public function userID()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'preload' => ['jr', "property"], 'preloadParams' => ['jr', "username"]]);
        return $this;
    }

    public function deviceID()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'preload' => ['jr', "property"], 'preloadParams' => ['jr', "deviceid"]]);
        return $this;
    }

    public function deprecatedID()
    {
        //$this->addTag(__FUNCTION__, null);
        return $this;
    }

    public function email()
    {
        //$this->addTag(__FUNCTION__, null);
        //if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type'=>"string",'preload'=>['jr',"property"],'preloadParams'=>['jr',"email"]]);
        return $this;
    }

    public function phoneNumber()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'preload' => ['jr', "property"], 'preloadParams' => ['jr', "phonenumber"]]);
        return $this;
    }

    public function simSerial()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'preload' => ['jr', "property"], 'preloadParams' => ['jr', "simserial"]]);
        return $this;
    }

    public function subscriberID()
    {
        $this->addUniqueTag(__FUNCTION__, null);
        if (Config::isOdk()) $this->setBind(__FUNCTION__, ['type' => "string", 'preload' => ['jr', "property"], 'preloadParams' => ['jr', "subscriberid"]]);
        return $this;
    }

    public function audit()
    {
        //$this->addTag(__FUNCTION__, null);
        return $this;
    }

    private function getPath($name)
    {
        return '/'.$this->root . '/meta/' . $name;
    }

    private function setBind($name, array $attribs)
    {
        if (!\in_array($name, $this->allowed, false)) return;
        $id = md5('meta/' . $name);
        $bind = Binds::get($id) ?: Bind::create($this->getPath($name));
        foreach ($attribs as $aname => $attrib) {
            if (\is_array($attrib)) {
                if (count($attrib) >= 2) {
                    $bind->setNSAttribute($attrib[0], $aname, $attrib[1]);
                } else $bind->setAttribute($aname, $attrib[0]);
            } else $bind->setAttribute($aname, $attrib);
        }
        Binds::add($bind, $id);
    }

    public function changeRoot($name)
    {
        $this->root = $name;
        foreach ($this->allowed as $item) {
            if ($bind = Binds::get(md5('meta/' . $item))) {
                $bind->nodeset($this->getPath($item));
            }
        }
        return $this;
    }


}