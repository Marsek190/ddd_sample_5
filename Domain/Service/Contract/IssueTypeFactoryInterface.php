<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;

interface IssueTypeFactoryInterface
{
    /**
     * @return InvalidFiasLevelType
     */
    public function getInvalidFiasLevelType();

    /**
     * @return ProductUnavailabilityType
     */
    public function getProductUnavailabilityType();

    /**
     * @return OrderInIssueStatusType
     */
    public function getOrderInIssueStatusType();

    /**
     * @return OrderInCancelStatusType
     */
    public function getOrderInCancelStatusType();
}
