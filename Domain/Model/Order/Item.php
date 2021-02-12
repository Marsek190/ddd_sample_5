<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order;

class Item
{
    /** @var string */
    public $productName;

    /** @var string */
    public $article;

    /** @var int */
    public $quantity;

    /** @var bool */
    public $isAvailable;

    /**
     * @param string $productName
     * @param string $article
     * @param int $quantity
     * @param bool $isAvailable
     */
    public function __construct($productName, $article, $quantity, $isAvailable)
    {
        $this->productName = $productName;
        $this->article = $article;
        $this->quantity = $quantity;
        $this->isAvailable = $isAvailable;
    }
}
