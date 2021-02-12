<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;

class DelayedOrderIssueNotificationFactory implements DelayedOrderIssueNotificationFactoryInterface
{
    private $addresses = [
        'Elena.Grishkina@technopark.ru',
        'Anatoliy.Sergeev@technopark.ru',
        'bi@aliway.ru',
    ];

    /**
     * @inheritDoc
     */
    public function make()
    {
        return new Notification(
            'Просрочено время решения по инциденту Aliexpress',
            null,
            $this->addresses,
            null
        );
    }
}
