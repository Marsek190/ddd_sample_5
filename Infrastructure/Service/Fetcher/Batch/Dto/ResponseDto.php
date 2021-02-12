<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto;

class ResponseDto
{
    public $count;
    public $next;
    public $previous;

    /** @var OrderDto[] */
    public $results;
}
