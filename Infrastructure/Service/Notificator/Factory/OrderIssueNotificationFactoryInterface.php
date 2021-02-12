<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;

interface OrderIssueNotificationFactoryInterface
{
    /**
     * @param Order $order
     * @param AbstractType $issueType
     * @return Notification
     */
    public function make(Order $order, AbstractType $issueType);
}
