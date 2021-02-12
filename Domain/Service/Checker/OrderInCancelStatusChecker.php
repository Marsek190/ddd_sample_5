<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

class OrderInCancelStatusChecker implements OrderIssueCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function orderHasIssue(Order $order)
    {
        return $this->orderInCancelStatus($order->status);
    }

    /**
     * @inheritDoc
     */
    public function orderIsFixed(Order $order)
    {
        return !$this->orderInCancelStatus($order->status) && $order->cancelReason !== 'seller_send_goods_timeout';
    }

    /**
     * @param string $orderStatus
     * @return bool
     */
    private function orderInCancelStatus($orderStatus)
    {
        return $orderStatus === 'IN_CANCEL';
    }
}
