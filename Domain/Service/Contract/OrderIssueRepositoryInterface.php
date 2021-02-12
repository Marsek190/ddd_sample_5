<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;

interface OrderIssueRepositoryInterface
{
    /**
     * @param array $orderIds
     * @return array
     */
    public function getByExternalOrderIds(array $orderIds);

    /**
     * @return OrderIssue[]
     */
    public function getAllDelayed();

    /**
     * @param OrderIssue $orderIssue
     */
    public function save(OrderIssue $orderIssue);
}
