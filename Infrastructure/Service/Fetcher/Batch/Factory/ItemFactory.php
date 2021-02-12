<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Item;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ItemDto;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Product\ProductManagerInterface;

class ItemFactory implements ItemFactoryInterface
{
    /** @var ProductManagerInterface */
    private $productManager;

    public function __construct(ProductManagerInterface $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * @inheritDoc
     */
    public function make(array $itemDtos)
    {
        $articles = array_flip($this->productManager->getAvailableProductArticles($itemDtos));

        $items = [];
        /** @var ItemDto $itemDto */
        foreach ($itemDtos as $itemDto) {
            $isAvailable = isset($articles[$itemDto->skuCode]);
            $items[] = new Item(
                $itemDto->name,
                $itemDto->skuCode,
                $itemDto->productCount,
                $isAvailable
            );
        }

        return $items;
    }
}
