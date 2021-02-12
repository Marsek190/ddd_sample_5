<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ResponseDto;

class ResponseDtoFactory implements ResponseDtoFactoryInterface
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function create(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();
        //$content = file_get_contents(__DIR__ . '/test_response.json');
        //$content = file_get_contents(__DIR__ . '/test_response_with_errors.json');

        return $this->serializer->deserialize($content, ResponseDto::class, 'json');
    }
}
