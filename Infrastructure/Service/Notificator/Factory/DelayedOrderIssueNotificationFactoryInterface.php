<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;

interface DelayedOrderIssueNotificationFactoryInterface
{
    /**
     * @return Notification
     */
    public function make();
}
