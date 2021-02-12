<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto\OrderIssueDto;

interface OrderIssueEntityFactoryInterface
{
    /**
     * @param OrderIssueDto $orderIssueDto
     * @return OrderIssue
     */
    public function make(OrderIssueDto $orderIssueDto);
}
