<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Product\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Product;

interface ProductFactoryInterface
{
    /**
     * @param string $article
     * @param bool $archived
     * @param int $stockBalance
     * @return Product
     */
    public function make($article, $archived, $stockBalance);
}
