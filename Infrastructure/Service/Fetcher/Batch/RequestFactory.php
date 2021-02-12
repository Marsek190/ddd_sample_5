<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch;

use DateTime;
use GuzzleHttp\Psr7\Request;
use Phalcon\Config;

class RequestFactory implements RequestFactoryInterface
{
    /** @var Config */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function create(DateTime $updatedSince, $limit, $offset)
    {
        $parameters = [
            'limit' => $limit,
            'offset' => $offset,
            'updated_from' => $updatedSince->getTimestamp(),
        ];

        $baseUrl = $this->config->path('aliexpress.api_base_url');
        $token = $this->config->path('aliexpress.token');

        return new Request(
            'GET',
            $baseUrl . 'orders?' . http_build_query($parameters),
            [
                'Authorization' => "Token $token",
            ]
        );
    }
}
