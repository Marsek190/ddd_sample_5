<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Application\Service\Handler;

use Exception;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DelayedOrderIssueNotificatorInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\LoggerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIssueRepositoryInterface;

class DelayedOrderIssueHandler implements DelayedOrderIssueHandlerInterface
{
    /** @var DelayedOrderIssueNotificatorInterface */
    private $notificator;

    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    /** @var OrderIssueRepositoryInterface */
    private $orderIssueRepository;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        DelayedOrderIssueNotificatorInterface $notificator,
        DateTimeFactoryInterface $dateTimeFactory,
        OrderIssueRepositoryInterface $orderIssueRepository,
        LoggerInterface $logger
    ) {
        $this->notificator = $notificator;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->orderIssueRepository = $orderIssueRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function handle()
    {
        try {
            $splitedIssues = $this->getDelayedSplitedIssuesByPeriod();
            if (empty($splitedIssues)) {
                return;
            }

            $this->notificator->notify($splitedIssues);
        } catch (Exception $e) {
            $this->logger->logException($e);
        }
    }

    /**
     * @return array
     */
    private function getDelayedSplitedIssuesByPeriod()
    {
        $lastDay = $this->dateTimeFactory->getLastDayDateTime();
        $delayedIssues = $this->orderIssueRepository->getAllDelayed();

        $splitedIssues = [];
        foreach ($delayedIssues as $issue) {
            if ($issue->dateTimeResolvedPlanned >= $lastDay) {
                $splitedIssues['last_day'][] = $issue;
            }

            $splitedIssues['other'][] = $issue;
        }

        return $splitedIssues;
    }
}
