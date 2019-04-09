<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 7:19 PM
 */

namespace Angujo\OpenRosaPhp\Models\Elements;


use Angujo\OpenRosaPhp\Libraries\Constraint;
use Angujo\OpenRosaPhp\Libraries\Elmt;
use Angujo\OpenRosaPhp\Libraries\Tag;

class Bind extends Tag
{
    private $nodeset;
    private $registered;
    /** @var Constraint */
    private $constraint;

    protected function __construct($nodeset, &$reg = true)
    {
        parent::__construct(Elmt::BIND, null);
        $this->nodeset = $nodeset;
        $this->registered = &$reg;
        $this->nodeset($nodeset);
    }

    /**
     * @return Constraint|null
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * @param Constraint $constraint
     * @return Bind
     */
    public function setConstraint(Constraint $constraint)
    {
        $this->constraint = &$constraint;
        return $this;
    }
    
    public function setRelevance($relevance)
    {
        $this->setAttribute('relevant', $relevance);
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return $this->registered;
    }

    /**
     * @param bool $registered
     * @return Bind
     */
    public function setRegistered(bool &$registered)
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
        $this->addAttribute('required', $req ? 'true()' : 'false()');
        return $this;
    }

    public function relevant($rel = true)
    {
        $this->addAttribute('relevant', $rel ? 'true()' : 'false()');
        return $this;
    }

    public function constraint($cnst)
    {
        $this->addAttribute('constraint',$cnst);
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

    /**
     * @param null|\XMLWriter $writer
     * @return \XMLWriter|null
     */
    public function XMLify($writer = null)
    {
        if (!$writer) return null;
        if ($this->constraint) {
            $this->constraint($this->constraint->getConstraint());
            $this->constraintMsg($this->constraint->getMessage());
        }
        $writer->startElement($this->getName());
        foreach ($this->attributes as $attribute) {
            if ($attribute->getNamespace()) {
                $writer->writeAttributeNS($attribute->getNamespace(), $attribute->getName(), null, $attribute->getValue());
            } else {
                $writer->writeAttribute($attribute->getName(), $attribute->getValue());
            }
        }
        $writer->endElement();
        return $writer;
    }
}