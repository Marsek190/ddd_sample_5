<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Handler\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

interface OrderIssueFactoryInterface
{
    /**
     * @param Order $order
     * @param AbstractType $issueType
     * @param $issueInfo
     * @return OrderIssue
     */
    public function make(Order $order, AbstractType $issueType, $issueInfo);

    /**
     * @param OrderIssue $orderIssue
     * @return OrderIssue
     */
    public function makeResolved(OrderIssue $orderIssue);
}
