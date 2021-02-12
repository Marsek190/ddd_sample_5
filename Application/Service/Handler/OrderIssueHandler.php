<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Application\Service\Handler;

use Exception;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Factory\OrderIssueCheckerFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Mapper\OrderIssueCheckerMapperInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\LoggerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIssueNotificatorInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIssueRepositoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Fetcher\OrderFetcherInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Handler\Factory\OrderIssueFactoryInterface;

class OrderIssueHandler implements OrderIssueHandlerInterface
{
    /** @var OrderFetcherInterface */
    private $orderFetcher;

    /** @var OrderIssueRepositoryInterface */
    private $orderIssueRepository;

    /** @var LoggerInterface */
    private $logger;

    /** @var OrderIssueCheckerFactoryInterface */
    private $checkerFactory;

    /** @var OrderIssueCheckerMapperInterface */
    private $checkerMapper;

    /** @var OrderIssueNotificatorInterface */
    private $notificator;

    /** @var OrderIssueFactoryInterface */
    private $orderIssueFactory;

    public function __construct(
        OrderFetcherInterface $orderFetcher,
        OrderIssueRepositoryInterface $orderIssueRepository,
        LoggerInterface $logger,
        OrderIssueCheckerFactoryInterface $checkerFactory,
        OrderIssueCheckerMapperInterface $checkerMapper,
        OrderIssueNotificatorInterface $notificator,
        OrderIssueFactoryInterface $orderIssueFactory
    ) {
        $this->orderFetcher = $orderFetcher;
        $this->orderIssueRepository = $orderIssueRepository;
        $this->logger = $logger;
        $this->checkerFactory = $checkerFactory;
        $this->checkerMapper = $checkerMapper;
        $this->notificator = $notificator;
        $this->orderIssueFactory = $orderIssueFactory;
    }

    /**
     * @inheritDoc
     */
    public function handle()
    {
        try {
            $orders = $orderIds = [];
            foreach ($this->orderFetcher->getUnhandledOrders() as $order) {
                $orders[] = $order;
                $orderIds[] = $order->id;
            }

            if (empty($orders)) {
                return;
            }

            $issuesByOrderId = $this->orderIssueRepository->getByExternalOrderIds($orderIds);
            $checkers = $this->checkerFactory->getCheckers();

            /** @var Order $order */
            foreach ($orders as $order) {

                $issuesByType = isset($issuesByOrderId[$order->id]) ? $issuesByOrderId[$order->id] : [];

                foreach ($checkers as $checker) {
                    $issueType = $this->checkerMapper->getIssueTypeByChecker($checker);
                    $orderIssue = $this->getOrderIssueByType($issuesByType, $issueType);

                    if ($checker->orderHasIssue($order) && !$this->orderIssueIsNotResolved($orderIssue)) {
                        // проблема не была сохранена в бд раннее или повторилась
                        $notification = $this->notificator->notify($order, $issueType);
                        $orderIssue = $this->orderIssueFactory->make($order, $issueType, $notification->getTheme());
                        $this->orderIssueRepository->save($orderIssue);
                    } elseif ($checker->orderIsFixed($order) && $this->orderIssueIsNotResolved($orderIssue)) {
                        // следим за тем, чтобы проблема была сохранена бд и не разрешалась раннее
                        $resolvedIssue = $this->orderIssueFactory->makeResolved($orderIssue);
                        $this->orderIssueRepository->save($resolvedIssue);
                    }
                }
            }
        } catch (Exception $e) {
            $this->logger->logException($e);
        }
    }

    /**
     * @param OrderIssue|null $orderIssue
     * @return bool
     */
    private function orderIssueIsNotResolved($orderIssue)
    {
        return !is_null($orderIssue) && !$orderIssue->isResolved;
    }

    /**
     * @param OrderIssue[] $issuesByType
     * @param AbstractType $issueType
     * @return OrderIssue|null
     */
    private function getOrderIssueByType(array $issuesByType, AbstractType $issueType)
    {
        return isset($issuesByType[get_class($issueType)]) ? $issuesByType[get_class($issueType)] : null;
    }
}
