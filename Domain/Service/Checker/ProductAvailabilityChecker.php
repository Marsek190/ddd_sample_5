<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Item;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

class ProductAvailabilityChecker implements OrderIssueCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function orderHasIssue(Order $order)
    {
        // если заказ был создан раннее - проверки опускаем,
        // т.к. проверять наличие на складе товаров из заказа уже не имеет смысла
        if (!is_null($order->publicId)) {
            return false;
        }

        return !$this->isCancelOrderByReasonClosedTrade($order->cancelReason) && !$this->checkAvailability($order->items);
    }

    /**
     * @inheritDoc
     */
    public function orderIsFixed(Order $order)
    {
        return $this->isCancelOrderByReasonClosedTrade($order->cancelReason);
    }

    /**
     * @param string $cancelReason
     * @return bool
     */
    private function isCancelOrderByReasonClosedTrade($cancelReason)
    {
        return $cancelReason === 'cancel_order_close_trade';
    }

    /**
     * @param Item[] $productItems
     * @return bool
     */
    private function checkAvailability(array $productItems)
    {
        foreach ($productItems as $item) {
            if (!$item->isAvailable) {
                return false;
            }
        }

        return true;
    }
}
