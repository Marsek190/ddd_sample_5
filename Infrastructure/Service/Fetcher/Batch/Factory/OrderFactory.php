<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\OrderDto;

class OrderFactory implements OrderFactoryInterface
{
    /** @var ItemFactoryInterface */
    private $itemFactory;

    /** @var LocationFactoryInterface */
    private $locationFactory;

    public function __construct(ItemFactoryInterface $itemFactory, LocationFactoryInterface $locationFactory)
    {
        $this->itemFactory = $itemFactory;
        $this->locationFactory = $locationFactory;
    }

    /**
     * @inheritDoc
     */
    public function make(OrderDto $orderDto, $publicOrderId)
    {
        $order = new Order();
        $order->id = (string) $orderDto->orderId;
        $order->publicId = $publicOrderId;
        $order->status = $orderDto->orderStatus;
        $order->issueStatus = $orderDto->issueStatus;
        $order->cancelReason = $orderDto->orderEndReason;
        $order->items = $this->itemFactory->make($orderDto->orderItems);

        if (isset($orderDto->addressFormatted[0]->fiasLevel)) {
            $order->location = $this->locationFactory->make((int) $orderDto->addressFormatted[0]->fiasLevel);
        }

        return $order;
    }
}
