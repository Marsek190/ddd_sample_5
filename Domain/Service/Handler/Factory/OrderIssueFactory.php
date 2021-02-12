<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Handler\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;

class OrderIssueFactory implements OrderIssueFactoryInterface
{
    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    public function __construct(DateTimeFactoryInterface $dateTimeFactory)
    {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @inheritDoc
     */
    public function make(Order $order, AbstractType $issueType, $issueInfo)
    {
        $orderIssueDto = new OrderIssue();

        $orderIssueDto->issue = $issueInfo;
        $orderIssueDto->issueType = $issueType;
        $orderIssueDto->dateTimeCreated = $this->dateTimeFactory->getCurrentDateTime();
        $orderIssueDto->publicOrderId = $order->publicId;
        $orderIssueDto->externalOrderId = $order->id;

        $timeForResolved = $this->getNeedTimeForResolved($issueType);
        $orderIssueDto->allottedTimeForResolveInHours = $timeForResolved;
        $orderIssueDto->dateTimeResolvedPlanned = $this->dateTimeFactory->getFromString(sprintf('+%s hours', $timeForResolved));

        return $orderIssueDto;
    }

    /**
     * @inheritDoc
     */
    public function makeResolved(OrderIssue $orderIssue)
    {
        $orderIssue->isResolved = true;
        $orderIssue->dateTimeResolved = $this->dateTimeFactory->getCurrentDateTime();

        return $orderIssue;
    }

    /**
     * @param AbstractType $issueType
     * @return int|null
     */
    private function getNeedTimeForResolved(AbstractType $issueType)
    {
        if (
            $issueType instanceof InvalidFiasLevelType ||
            $issueType instanceof OrderInCancelStatusType ||
            $issueType instanceof ProductUnavailabilityType
        ) {
            return 24;
        }

        if ($issueType instanceof OrderInIssueStatusType) {
            return 120;
        }

        return null;
    }
}
