<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Mapper;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderIssueCheckerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\InvalidFiasLevelChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderInCancelStatusChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderInIssueStatusChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\ProductAvailabilityChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\IssueTypeFactoryInterface;

class OrderIssueCheckerMapper implements OrderIssueCheckerMapperInterface
{
    /** @var IssueTypeFactoryInterface */
    private $issueTypeFactory;

    /** @var array */
    private $classesMap;

    public function __construct(IssueTypeFactoryInterface $issueTypeFactory)
    {
        $this->issueTypeFactory = $issueTypeFactory;
        $this->classesMap = $this->getMap();
    }

    /**
     * @inheritDoc
     */
    public function getIssueTypeByChecker(OrderIssueCheckerInterface $checker)
    {
        $class = $this->classesMap[get_class($checker)];
        switch ($class) {
            case InvalidFiasLevelType::class:
                return $this->issueTypeFactory->getInvalidFiasLevelType();
            case ProductUnavailabilityType::class:
                return $this->issueTypeFactory->getProductUnavailabilityType();
            case OrderInCancelStatusType::class:
                return $this->issueTypeFactory->getOrderInCancelStatusType();
            case OrderInIssueStatusType::class:
                return $this->issueTypeFactory->getOrderInIssueStatusType();
        }

        return null;
    }

    private function getMap()
    {
        return [
            InvalidFiasLevelChecker::class => InvalidFiasLevelType::class,
            OrderInCancelStatusChecker::class => OrderInCancelStatusType::class,
            OrderInIssueStatusChecker::class => OrderInIssueStatusType::class,
            ProductAvailabilityChecker::class => ProductUnavailabilityType::class,
        ];
    }
}
