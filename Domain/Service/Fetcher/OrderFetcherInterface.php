<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Fetcher;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

interface OrderFetcherInterface
{
    /**
     * @return Order[]
     */
    public function getUnhandledOrders();
}
