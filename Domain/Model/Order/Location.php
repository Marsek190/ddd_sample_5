<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order;

class Location
{
    /** @var int */
    public $fiasLevel;

    /**
     * @param int $fiasLevel
     */
    public function __construct($fiasLevel)
    {
        $this->fiasLevel = $fiasLevel;
    }
}
