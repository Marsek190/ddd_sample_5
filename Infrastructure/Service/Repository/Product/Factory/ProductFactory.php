<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Product\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Product;

class ProductFactory implements ProductFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function make($article, $archived, $stockBalance)
    {
        return new Product($article, $archived, $stockBalance);
    }
}
