<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto\OrderIssueDto;

interface OrderIssueDtoFactoryInterface
{
    /**
     * @param OrderIssue $orderIssue
     * @return OrderIssueDto
     */
    public function make(OrderIssue $orderIssue);
}
