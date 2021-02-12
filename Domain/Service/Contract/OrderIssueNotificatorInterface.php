<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

interface OrderIssueNotificatorInterface
{
    /**
     * @param Order $order
     * @param AbstractType $issueType
     * @return Notification
     */
    public function notify(Order $order, AbstractType $issueType);
}
