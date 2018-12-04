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

class Bind extends Tag
{
    private $nodeset;
    private $registered;

    protected function __construct($nodeset, &$reg = true)
    {
        parent::__construct(Elmt::BIND, null);
        $this->nodeset = $nodeset;
        $this->registered = &$reg;
        $this->nodeset($nodeset);
    }

    /**
     * @return bool
     */
    public function isRegistered(): bool
    {
        return $this->registered;
    }

    /**
     * @param bool $registered
     * @return Bind
     */
    public function setRegistered(bool &$registered): Bind
    {
        $this->registered = &$registered;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNodeset()
    {
        return $this->nodeset;
    }

    /**
     * @param $nodeset
     * @param bool $reg
     * @return Bind
     */
    public static function create($nodeset, &$reg = true)
    {
        return new self($nodeset, $reg);
    }

    public function nodeset($value)
    {
        $this->setAttribute('nodeset', $value);
        return $this;
    }

    public function type($type)
    {
        $type = \in_array($type, Elmt::$DATA_TYPES, false) ? $type : 'string';
        $this->addAttribute('type', $type);
        return $this;
    }

    public function readonly($read = true)
    {
        $this->addAttribute('readonly', $read ? 'true()' : 'false()');
        return $this;
    }

    public function required($req = true)
    {
        $this->addAttribute('readonly', $req ? 'true()' : 'false()');
        return $this;
    }

    public function relevant($rel = true)
    {
        $this->addAttribute('readonly', $rel ? 'true()' : 'false()');
        return $this;
    }

    public function constraint($cnst)
    {
        $this->addAttribute('constraint', htmlspecialchars($cnst));
        return $this;
    }

    public function calculate($calc)
    {
        $this->addAttribute('calculate', $calc);
        return $this;
    }

    public function saveIncomplete($save = true)
    {
        $this->addAttribute('readonly', $save ? 'true()' : 'false()');
        return $this;
    }

    public function requiredMsg($msg)
    {
        $this->addNSAttribute('jr', 'requiredMsg', $msg);
        return $this;
    }

    public function constraintMsg($msg)
    {
        $this->addNSAttribute('jr', 'constraintMsg', $msg);
        return $this;
    }

    public function preload($prl)
    {
        $this->addNSAttribute('jr', 'preload', $prl);
        return $this;
    }

    public function preloadParams($prl)
    {
        $this->addNSAttribute('jr', 'preloadParams', $prl);
        return $this;
    }

    public function maxPixels($mxpls)
    {
        $this->addNSAttribute('orx', 'max-pixels', $mxpls);
        return $this;
    }
}