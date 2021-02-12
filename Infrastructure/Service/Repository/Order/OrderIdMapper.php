<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order;

use PDO;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DBALException;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIdMapperInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Mapper\OrderPropertyMapperInterface;

class OrderIdMapper implements OrderIdMapperInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var OrderPropertyMapperInterface */
    private $orderPropertyMapper;

    public function __construct(EntityManagerInterface $entityManager, OrderPropertyMapperInterface $orderPropertyMapper)
    {
        $this->entityManager = $entityManager;
        $this->orderPropertyMapper = $orderPropertyMapper;
    }

    /**
     * @inheritDoc
     */
    public function getPublicOrderIdsByExternalOrderIds(array $externalOrderIds)
    {
        try {
            $query = '
                SELECT
                    order_prop_public.VALUE AS public_id,
                    order_prop_external.VALUE AS external_id
                FROM b_sale_order internal_order
                INNER JOIN b_sale_order_props_value order_prop_public
                    ON order_prop_public.ORDER_PROPS_ID = ? AND internal_order.ID = order_prop_public.ORDER_ID
                INNER JOIN b_sale_order_props_value order_prop_external
                    ON order_prop_external.ORDER_PROPS_ID = ?
                    AND order_prop_external.VALUE IN (?) AND internal_order.ID = order_prop_external.ORDER_ID
                INNER JOIN b_sale_order_props_value shop_prop
                    ON shop_prop.ORDER_PROPS_ID = ?
                    AND shop_prop.VALUE = ? AND internal_order.ID = shop_prop.ORDER_ID
            ';

            $params = [
                $this->orderPropertyMapper->getTechnoparkPublicOrderIdPropertyId(),
                $this->orderPropertyMapper->getPartnerOrderIdPropertyId(),
                $externalOrderIds,
                $this->orderPropertyMapper->getShopPropertyId(),
                $this->orderPropertyMapper->getShop(),
            ];
            $types = [
                PDO::PARAM_INT,
                PDO::PARAM_INT,
                Connection::PARAM_STR_ARRAY,
                PDO::PARAM_INT,
                PDO::PARAM_STR,
            ];
            $stmt = $this->entityManager->getConnection()->executeQuery($query, $params, $types);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_column($orders, 'public_id', 'external_id');
        } catch (DBALException $e) {
            return [];
        }
    }
}
