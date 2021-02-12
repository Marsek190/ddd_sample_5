<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

interface OrderIssueCheckerInterface
{
    /**
     * @param Order $order
     * @return bool
     */
    public function orderHasIssue(Order $order);

    /**
     * @param Order $order
     * @return bool
     */
    public function orderIsFixed(Order $order);
}
