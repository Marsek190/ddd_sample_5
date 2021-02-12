<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher;

use GuzzleHttp\ClientInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIdMapperInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Fetcher\OrderFetcherInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\OrderDto;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory\OrderFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\RequestFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\ResponseDtoFactoryInterface;

class OrderFetcher implements OrderFetcherInterface
{
    /** @var ClientInterface */
    private $httpClient;

    /** @var OrderFactoryInterface */
    private $orderFactory;

    /** @var RequestFactoryInterface */
    private $requestFactory;

    /** @var ResponseDtoFactoryInterface */
    private $responseDtoFactory;

    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    /** @var OrderIdMapperInterface */
    private $orderMapper;

    public function __construct(
        ClientInterface $httpClient,
        OrderFactoryInterface $orderFactory,
        RequestFactoryInterface $requestFactory,
        ResponseDtoFactoryInterface $responseDtoFactory,
        DateTimeFactoryInterface $dateTimeFactory,
        OrderIdMapperInterface $orderMapper
    ) {
        $this->httpClient = $httpClient;
        $this->orderFactory = $orderFactory;
        $this->requestFactory = $requestFactory;
        $this->responseDtoFactory = $responseDtoFactory;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->orderMapper = $orderMapper;
    }

    /**
     * @inheritDoc
     */
    public function getUnhandledOrders()
    {
        $offset = 0;
        $updatedSince = $this->dateTimeFactory->getCurrentDateTime()->modify($this->getUpdateIntervalString());
        while (true) {
            $request = $this->requestFactory->create(
                $updatedSince,
                $this->getOrderChunkSize(),
                $offset
            );
            $response = $this->httpClient->send($request);
            $responseDto = $this->responseDtoFactory->create($response);

            if (empty($responseDto->results)) {
                break;
            }

            $externalOrderIds = array_map(function (OrderDto $orderDto) {
                return (string) $orderDto->orderId;
            }, $responseDto->results);
            $orders = $this->orderMapper->getPublicOrderIdsByExternalOrderIds($externalOrderIds);

            foreach ($responseDto->results as $orderDto) {
                $publicOrderId = isset($orders[$orderDto->orderId]) ? (int)$orders[$orderDto->orderId] : null;

                yield $this->orderFactory->make($orderDto, $publicOrderId);
            }

            if (empty($responseDto->next)) {
                break;
            }

            $offset += $this->getOrderChunkSize();
        }
    }

    /**
     * @return int
     */
    private function getOrderChunkSize()
    {
        return 100;
    }

    /**
     * @return string
     */
    private function getUpdateIntervalString()
    {
        return '-2 hours';
    }
}
