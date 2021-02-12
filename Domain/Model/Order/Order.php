<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order;

class Order
{
    /** @var string */
    public $id;

    /** @var int|null */
    public $publicId; // номер заказа в технопарк

    /** @var string */
    public $status;

    /** @var string */
    public $issueStatus;

    /** @var string */
    public $cancelReason;

    /** @var Location|null */
    public $location = null;

    /** @var Item[] */
    public $items;

    /**
     * @return array
     */
    public function toArray()
    {
        $orderItems = [];
        foreach ($this->items as $item) {
            $orderItems[] = [
                'name' => $item->productName,
                'sku_code' => $item->article,
                'product_count' => $item->quantity,
            ];
        }

        $fiasLevel = isset($this->location->fiasLevel) ? $this->location->fiasLevel : null;

        return [
           'order_id' => $this->id,
           'order_status' => $this->status,
           'issue_status' => $this->issueStatus,
           'order_end_reason' => $this->cancelReason,
           'address_formatted' => [
               'fias_level' => $fiasLevel,
           ],
           'order_items' => $orderItems,
       ];
    }
}
