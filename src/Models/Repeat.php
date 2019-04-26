<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 12:20 PM
 */

namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Libraries\Elmt;

class Repeat extends ControlHolder
{
    protected $no_ref;
    /** @var \Angujo\OpenRosaPhp\Models\Group */
    protected $group;
    private   $rpt_xpath;
    private   $lbl_rpt;
    
    protected function __construct($name = NULL)
    {
        $this->rpt_xpath = $name ?: uniqid('ch', FALSE);
        parent::__construct(Elmt::REPEAT, $this->rpt_xpath);
    }
    
    public function &getGroup()
    {
        if ($this->group) return $this->group;
        $this->group = Group::forRepeat($this->rpt_xpath);
        if ($this->lbl_rpt) $this->group->setLabel($this->lbl_rpt);
        $this->group->addElement($this);
        return $this->group;
    }
    
    public function setLabel($label)
    {
        $this->lbl_rpt = $label;
        $this->getGroup()->setLabel($label);
        return $this;
    }
    
    /**
     * @param null|string $name
     *
     * @return Repeat
     */
    public static function create($name = NULL)
    {
        return new self($name);
    }
    
    /**
     * @param int $times
     *
     * @return $this
     */
    public function count($times)
    {
        $times = !is_numeric($times) ? 2 : (int)$times;
        return $this->addNSAttribute('jr', 'count', $times);
    }
}