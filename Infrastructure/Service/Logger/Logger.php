<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Logger;

use Exception;
use GuzzleHttp\ClientInterface;
use Phalcon\Config;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\LoggerInterface;

class Logger implements LoggerInterface
{
    /** @var Config */
    private $config;

    /** @var ClientInterface */
    private $httpClient;

    public function __construct(Config $config, ClientInterface $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function logException(Exception $exception)
    {
        $this->logMessage($exception->getMessage());
    }

    /**
     * @param string $message
     * @return void
     */
    private function logMessage($message)
    {
        $this->sendMessageToRocketChat($message);
    }

    /** @param string $message */
    private function sendMessageToRocketChat($message)
    {
        $channelConfig = $this->config->path('rocket_chat')->toArray();
        $headers = [
            'X-User-Id' => $channelConfig['userId'],
            'X-Auth-Token' => $channelConfig['token'],
        ];
        $requestedParams = [
            'text' => $message,
            'channel' => $this->config->path('aliexpress.error_channel'),
            'alias' => $this->getAlias(),
        ];

        $this->httpClient->request(
            'POST',
            $channelConfig['baseUri'] . 'chat.postMessage',
            [
                'headers' => $headers,
                'form_params' => $requestedParams,
                'timeout' => 5,
            ]
        );
    }

    /**
     * Возвращает alias по умолчанию
     *
     * @return string
     */
    private function getAlias()
    {
        return getenv('USER') . '@' . ENV;
    }
}
