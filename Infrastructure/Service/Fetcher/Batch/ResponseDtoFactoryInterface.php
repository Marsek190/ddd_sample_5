<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch;

use Psr\Http\Message\ResponseInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ResponseDto;

interface ResponseDtoFactoryInterface
{
    /**
     * Создает DTO ответа на запрос на массовое получение заказов
     *
     * @param ResponseInterface $response
     * @return ResponseDto
     */
    public function create(ResponseInterface $response);
}
