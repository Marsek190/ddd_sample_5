<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

interface OrderIdMapperInterface
{
    /**
     * @param array $externalOrderIds
     * @return array
     */
    public function getPublicOrderIdsByExternalOrderIds(array $externalOrderIds);
}
