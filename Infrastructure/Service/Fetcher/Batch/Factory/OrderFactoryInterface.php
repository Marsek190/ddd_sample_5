<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\OrderDto;

interface OrderFactoryInterface
{
    /**
     * @param OrderDto $orderDto
     * @param int|null $publicOrderId
     * @return Order
     */
    public function make(OrderDto $orderDto, $publicOrderId);
}
