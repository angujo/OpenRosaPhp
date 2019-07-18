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
        if (method_exists($this, 'getOverlay')) {
            $this->getOverlay()->setNodeSet($this->fullNodeSet());
            return $this;
        }
        $this->trickleDown();
        return $this;
    }
}