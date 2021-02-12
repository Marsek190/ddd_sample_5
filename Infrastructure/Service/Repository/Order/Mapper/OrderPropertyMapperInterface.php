<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Mapper;

interface OrderPropertyMapperInterface
{
    /**
     * @return int
     */
    public function getTechnoparkPublicOrderIdPropertyId();

    /**
     * @return int
     */
    public function getPartnerOrderIdPropertyId();

    /**
     * @return int
     */
    public function getShopPropertyId();

    /**
     * @return string
     */
    public function getShop();
}
