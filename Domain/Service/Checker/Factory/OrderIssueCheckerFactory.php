<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\Factory;

use Exception;
use Common\Base\Di\Container;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\InvalidFiasLevelChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderInCancelStatusChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\OrderInIssueStatusChecker;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Checker\ProductAvailabilityChecker;

class OrderIssueCheckerFactory implements OrderIssueCheckerFactoryInterface
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function getCheckers()
    {
        try {
            return [
                $this->container->get(InvalidFiasLevelChecker::class),
                $this->container->get(OrderInCancelStatusChecker::class),
                $this->container->get(OrderInIssueStatusChecker::class),
                $this->container->get(ProductAvailabilityChecker::class),
            ];
        } catch (Exception $e) {
            return [];
        }
    }
}
