<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Mapper;

class OrderPropertyMapper implements OrderPropertyMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getTechnoparkPublicOrderIdPropertyId()
    {
       return 96;
    }

    /**
     * @inheritDoc
     */
    public function getPartnerOrderIdPropertyId()
    {
        return 130;
    }

    /**
     * @inheritDoc
     */
    public function getShopPropertyId()
    {
        return 37;
    }

    /**
     * @inheritDoc
     */
    public function getShop()
    {
        return 'AliExpress';
    }
}
