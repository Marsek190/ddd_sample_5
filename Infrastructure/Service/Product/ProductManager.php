<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Product;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\ProductRepositoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ItemDto;

class ProductManager implements ProductManagerInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAvailableProductArticles(array $productItems)
    {
        $articles = [];
        /** @var ItemDto $item */
        foreach ($productItems as $item) {
            $articles[] = $item->skuCode;
        }

        $products = $this->productRepository->getByArticles($articles);

        $availableArticles = [];
        /** @var ItemDto $item */
        foreach ($productItems as $item) {
            $product = isset($products[$item->skuCode]) ? $products[$item->skuCode] : null;
            if (is_null($product) || $product->archived || $product->stockBalance <= $item->productCount) {
                continue;
            }

            $availableArticles[] = $item->skuCode;
        }

        return $availableArticles;
    }

    /**
     * @inheritDoc
     */
    public function getUnavailableProductNames(array $productItems)
    {
        $productNames = [];
        foreach ($productItems as $item) {
            if (!$item->isAvailable) {
                $productNames[] = $item->productName;
            }
        }

        return $productNames;
    }
}
