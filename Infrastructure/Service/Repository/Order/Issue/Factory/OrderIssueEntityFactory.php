<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto\OrderIssueDto;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Mapper\IssueTypeMapperInterface;

class OrderIssueEntityFactory implements OrderIssueEntityFactoryInterface
{
    /** @var IssueTypeMapperInterface */
    private $issueTypeMapper;

    public function __construct(IssueTypeMapperInterface $issueTypeMapper)
    {
        $this->issueTypeMapper = $issueTypeMapper;
    }

    /**
     * @inheritDoc
     */
    public function make(OrderIssueDto $orderIssueDto)
    {
        $orderIssue = new OrderIssue();

        $orderIssue->id = $orderIssueDto->id;
        $orderIssue->dateTimeResolved = $orderIssueDto->dateTimeResolved;
        $orderIssue->dateTimeResolvedPlanned = $orderIssueDto->dateTimeResolvedPlanned;
        $orderIssue->dateTimeCreated = $orderIssueDto->dateTimeCreated;
        $orderIssue->issue = $orderIssueDto->issue;
        $orderIssue->issueType = $this->issueTypeMapper->getTypeByCode($orderIssueDto->issueType);
        $orderIssue->publicOrderId = $orderIssueDto->publicOrderId;
        $orderIssue->externalOrderId = $orderIssueDto->externalOrderId;
        $orderIssue->isResolved = $orderIssueDto->isResolved;
        $orderIssue->allottedTimeForResolveInHours = $orderIssueDto->allottedTimeForResolveInHours;

        return $orderIssue;
    }
}
