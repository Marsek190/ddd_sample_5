<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Location;

class LocationFactory implements LocationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function make($fiasLevel)
    {
        return new Location($fiasLevel);
    }
}
