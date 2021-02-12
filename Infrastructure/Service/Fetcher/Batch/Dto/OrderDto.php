<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto;

class OrderDto
{
    /** @var string */
    public $orderId;

    /** @var string */
    public $orderStatus;

    /** @var string */
    public $issueStatus;

    /** @var string */
    public $orderEndReason;

    /** @var FormattedAddressDto[]|null */
    public $addressFormatted;

    /** @var ItemDto[] */
    public $orderItems;
}
