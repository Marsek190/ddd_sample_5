<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Location;

interface LocationFactoryInterface
{
    /**
     * @param int $fiasLevel
     * @return Location
     */
    public function make($fiasLevel);
}
