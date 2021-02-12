<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Exception;

interface DelayedOrderIssueNotificatorInterface
{
    /**
     * @param array $splitedIssues
     * @throws Exception
     * @return void
     */
    public function notify(array $splitedIssues);
}
