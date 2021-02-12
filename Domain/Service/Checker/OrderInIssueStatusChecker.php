<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

class OrderInIssueStatusChecker implements OrderIssueCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function orderHasIssue(Order $order)
    {
        return $order->issueStatus === 'IN_ISSUE';
    }

    /**
     * @inheritDoc
     */
    public function orderIsFixed(Order $order)
    {
        return $order->issueStatus === 'NO_ISSUE';
    }
}
