<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto\OrderIssueDto;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Mapper\IssueTypeMapperInterface;

class OrderIssueDtoFactory implements OrderIssueDtoFactoryInterface
{
    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    /** @var IssueTypeMapperInterface */
    private $issueTypeMapper;

    public function __construct(DateTimeFactoryInterface $dateTimeFactory, IssueTypeMapperInterface $issueTypeMapper)
    {
        $this->dateTimeFactory = $dateTimeFactory;
        $this->issueTypeMapper = $issueTypeMapper;
    }

    /**
     * @inheritDoc
     */
    public function make(OrderIssue $orderIssue)
    {
        $orderIssueDto = new OrderIssueDto();

        $orderIssueDto->id = $orderIssue->id;
        $orderIssueDto->dateTimeResolved = $orderIssue->dateTimeResolved;
        $orderIssueDto->dateTimeResolvedPlanned = $orderIssue->dateTimeResolvedPlanned;
        $orderIssueDto->dateTimeCreated = $orderIssue->dateTimeCreated;
        $orderIssueDto->issue = $orderIssue->issue;
        $orderIssueDto->issueType = $this->issueTypeMapper->getTypeCode($orderIssue->issueType);
        $orderIssueDto->publicOrderId = $orderIssue->publicOrderId;
        $orderIssueDto->externalOrderId = $orderIssue->externalOrderId;
        $orderIssueDto->isResolved = $orderIssue->isResolved;
        $orderIssueDto->allottedTimeForResolveInHours = $orderIssue->allottedTimeForResolveInHours;

        return $orderIssueDto;
    }
}
