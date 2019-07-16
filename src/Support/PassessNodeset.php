<?php


namespace Angujo\OpenRosaPhp\Support;


/**
 * Trait PassessNodeset
 *
 * @package Angujo\OpenRosaPhp\Support
 */
trait PassessNodeset
{
    private $t_nodeset = [];

    /**
     * @return array
     */
    public function fullNodeSet(): array
    {
        return $this->t_nodeset;
    }

    /**
     * @param array $nodeset
     *
     * @return $this
     */
    public function setNodeset(array $nodeset)
    {
        $this->t_nodeset = $nodeset;
        $this->trickleDown();
        return $this;
    }
}