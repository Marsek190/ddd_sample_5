<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderIssueCheckerInterface;

interface OrderIssueCheckerFactoryInterface
{
    /**
     * @return OrderIssueCheckerInterface[]
     */
    public function getCheckers();
}
