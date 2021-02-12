<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\IssueTypeFactoryInterface;

class IssueTypeFactory implements IssueTypeFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function getInvalidFiasLevelType()
    {
        return new InvalidFiasLevelType();
    }

    /**
     * @inheritDoc
     */
    public function getProductUnavailabilityType()
    {
        return new ProductUnavailabilityType();
    }

    /**
     * @inheritDoc
     */
    public function getOrderInIssueStatusType()
    {
        return new OrderInIssueStatusType();
    }

    /**
     * @inheritDoc
     */
    public function getOrderInCancelStatusType()
    {
        return new OrderInCancelStatusType();
    }
}
