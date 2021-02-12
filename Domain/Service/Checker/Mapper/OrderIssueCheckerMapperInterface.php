<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Mapper;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderIssueCheckerInterface;

interface OrderIssueCheckerMapperInterface
{
    /**
     * @param OrderIssueCheckerInterface $checker
     * @return AbstractType
     */
    public function getIssueTypeByChecker(OrderIssueCheckerInterface $checker);
}
