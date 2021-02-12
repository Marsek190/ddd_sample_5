<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Application\Service\Handler;

interface DelayedOrderIssueHandlerInterface
{
    /**
     * @return void
     */
    public function handle();
}
