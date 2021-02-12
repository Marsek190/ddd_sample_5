<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Product;

use PDO;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DBALException;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\ProductRepositoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Product\Factory\ProductFactoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ProductFactoryInterface */
    private $productFactory;

    public function __construct(EntityManagerInterface $entityManager, ProductFactoryInterface $productFactory)
    {
        $this->entityManager = $entityManager;
        $this->productFactory = $productFactory;
    }

    /**
     * @inheritDoc
     */
    public function getByArticles(array $articles)
    {
        if (empty($articles)) {
            return [];
        }

        try {
            $query = '
                SELECT DISTINCT
                    f.ARTICLE AS article,
                    f.ARCHIVE AS archived,
                    r.QUANTITY_PRODUCTS AS stock_balance
                FROM TP_CATALOG_FACET f
                LEFT JOIN TB_REMAINS r ON (f.ARTICLE = r.CODE_PRODUCT AND r.CODE_SHOP = ?)
                WHERE f.ARTICLE IN (?)
            ';

            $params = ['01', $articles];
            $types = [Type::STRING, Connection::PARAM_STR_ARRAY];
            $stmt = $this->entityManager->getConnection()->executeQuery($query, $params, $types);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            /** @var array $product */
            foreach ($result as $product) {
                $products[$product['article']] = $this->productFactory->make(
                    $product['article'],
                    $product['archived'] == '1',
                    (int) $product['stock_balance']
                );
            }

            return $products;
        } catch (DBALException $e) {
            return [];
        }
    }
}
