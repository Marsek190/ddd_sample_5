<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

class InvalidFiasLevelChecker implements OrderIssueCheckerInterface
{
    /** @var array */
    private $availableFiasLevels = [7, 8, 65, 90, 91];

    public function __construct()
    {
        $this->availableFiasLevels = array_flip($this->availableFiasLevels);
    }

    /**
     * @inheritDoc
     */
    public function orderHasIssue(Order $order)
    {
        return !$this->fiasLevelIsStreetOrDeeper($order);
    }

    /**
     * @inheritDoc
     */
    public function orderIsFixed(Order $order)
    {
        return $this->fiasLevelIsStreetOrDeeper($order) && !is_null($order->publicId);
    }

    /**
     * @param Order $order
     * @return bool
     */
    private function fiasLevelIsStreetOrDeeper(Order $order)
    {
        if (!empty($order->location)) {
            return isset($this->availableFiasLevels[$order->location->fiasLevel]);
        }

        return false;
    }
}
