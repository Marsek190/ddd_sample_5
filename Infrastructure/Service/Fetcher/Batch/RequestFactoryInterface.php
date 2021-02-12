<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch;

use DateTime;
use Psr\Http\Message\RequestInterface;

interface RequestFactoryInterface
{
    /**
     * Создает запрос на массовое получение заказов
     *
     * @param DateTime $updatedSince
     * @param int $limit
     * @param int $offset
     * @return RequestInterface
     */
    public function create(DateTime $updatedSince, $limit, $offset);
}
