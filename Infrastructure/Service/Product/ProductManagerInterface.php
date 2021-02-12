<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Product;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Item;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ItemDto;

interface ProductManagerInterface
{
    /**
     * @param ItemDto[] $productItems
     * @return array
     */
    public function getAvailableProductArticles(array $productItems);

    /**
     * @param Item[] $productItems
     * @return array
     */
    public function getUnavailableProductNames(array $productItems);
}
