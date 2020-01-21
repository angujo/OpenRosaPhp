<?php


namespace Angujo\OpenRosaPhp\Core;


use Angujo\OpenRosaPhp\Support\TranslatedAttribute;
use Angujo\OpenRosaPhp\Tag;

class Bind extends XMLTag
{
    private $min_value;
    private $max_value;

    public function __construct() { parent::__construct(Tag::BIND); }

    /**
     * @param bool $require
     *
     * @return $this
     * @throws OException
     */
    public function setRequired($require = true)
    {
        $this->addAttribute('required', $require ? 'true()' : 'false()');
        return $this;
    }

    public function setReadOnly($require = true)
    {
        $this->addAttribute('readonly', $require ? 'true()' : 'false()');
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     * @throws OException
     */
    public function setType($value)
    {
        $this->addAttribute('type', (string)$value);
        return $this;
    }

    public function minValue($val)
    {
        $this->min_value = $val;
        return $this;
    }

    public function maxValue($val)
    {
        $this->max_value = $val;
        return $this;
    }

    public function getRelevant()
    {
        return $this->getAttribute('relevant');
    }

    public function setRelevant($revelant)
    {
        return $this->addAttribute('relevant', $revelant);
    }

    public function setConstraint($constraint)
    {
        return $this->addAttribute('constraint', $constraint);
    }

    public function getConstraint()
    {
        return $this->getAttribute('constraint');
    }

    public function setConstraintMessage($msg)
    {
        return $this->addAttribute((new Attribute('constraintMsg'))->setNamespace('jr')->setValue($msg));
        /** @var TranslatedAttribute $mattr */
        // $mattr = $this->getAttribute('constraintMsg') ?: (new TranslatedAttribute('constraintMsg'))->setNamespace('jr');
        // $this->addAttribute($mattr);
        // return $mattr->setValue($msg);
    }

    public function setRequiredMessage($msg)
    {
        return $this->addAttribute('requiredMsg', $msg);
        /** @var TranslatedAttribute $mattr */
        // $mattr = $this->getAttribute('requiredMsg') ?: (new TranslatedAttribute('requiredMsg'))->setNamespace('jr');
        // $this->addAttribute($mattr);
        // return $mattr->setValue($msg);
    }

    public function setCalculation($calculation)
    {
        return $this->addAttribute('calculate', $calculation);
    }

    public function getCalculation()
    {
        return $this->getAttribute('calculate');
    }

    public function setNodeSet(string $nodeset)
    {
        return $this->addAttribute('nodeset', $nodeset);
    }

    public function setPreload(string $preload)
    {
        return $this->addAttribute((new Attribute('preload'))->setNamespace('jr')->setValue($preload));
    }

    public function setPreloadParams(string $params)
    {
        return $this->addAttribute((new Attribute('preloadParams'))->setNamespace('jr')->setValue($params));
    }
}