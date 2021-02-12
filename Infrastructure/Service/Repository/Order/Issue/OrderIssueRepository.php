<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue;

use Doctrine\ORM\EntityManagerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIssueRepositoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto\OrderIssueDto;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory\OrderIssueDtoFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory\OrderIssueEntityFactoryInterface;

class OrderIssueRepository implements OrderIssueRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    /** @var OrderIssueEntityFactoryInterface */
    private $issueEntityFactory;

    /** @var OrderIssueDtoFactoryInterface */
    private $issueDtoFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        DateTimeFactoryInterface $dateTimeFactory,
        OrderIssueEntityFactoryInterface $issueEntityFactory,
        OrderIssueDtoFactoryInterface $issueDtoFactory
    ) {
        $this->entityManager = $entityManager;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->issueEntityFactory = $issueEntityFactory;
        $this->issueDtoFactory = $issueDtoFactory;
    }

    /**
     * @inheritDoc
     */
    public function getByExternalOrderIds(array $orderIds)
    {
        if (empty($orderIds)) {
            return [];
        }

        $qb = $this->entityManager->createQueryBuilder();
        $result = $qb->from(OrderIssueDto::class, 'i')
            ->select('i')
            ->where($qb->expr()->in('i.externalOrderId', $orderIds))
            ->orderBy('i.dateTimeCreated', 'DESC')
            ->getQuery()
            ->getResult();

        $issues = $issueGrouped = [];
        /** @var OrderIssueDto $issueDto */
        foreach ($result as $issueDto) {
            if (isset($issueGrouped[$issueDto->externalOrderId][$issueDto->issueType])) {
                continue;
            }

            $issue = $this->issueEntityFactory->make($issueDto);
            $issues[$issueDto->externalOrderId][get_class($issue->issueType)] = $issue;
            $issueGrouped[$issueDto->externalOrderId][$issueDto->issueType] = true;
        }

        return $issues;
    }

    /**
     * @inheritDoc
     */
    public function getAllDelayed()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $now = $this->dateTimeFactory->getCurrentDateTime();

        $result = $qb->from(OrderIssueDto::class, 'i')
            ->select('i')
            ->where($qb->expr()->eq('i.isResolved', '0'))
            ->andWhere('i.dateTimeResolvedPlanned <= :now')
            ->setParameter('now', $now->format($this->dateTimeFactory->getYmdHisFormat()))
            ->getQuery()
            ->getResult();

        $delayed = [];
        /** @var OrderIssueDto $issueDto */
        foreach ($result as $issueDto) {
            $delayed[] = $this->issueEntityFactory->make($issueDto);
        }

        return $delayed;
    }

    /**
     * @inheritDoc
     */
    public function save(OrderIssue $orderIssue)
    {
        $orderIssueDto = $this->issueDtoFactory->make($orderIssue);
        $this->entityManager->merge($orderIssueDto);
        $this->entityManager->flush();
    }
}
