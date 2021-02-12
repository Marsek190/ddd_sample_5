<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Product;

interface ProductRepositoryInterface
{
    /**
     * @param array $articles
     * @return Product[]
     */
    public function getByArticles(array $articles);
}
