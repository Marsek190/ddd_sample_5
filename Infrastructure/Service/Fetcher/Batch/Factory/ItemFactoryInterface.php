<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Item;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Fetcher\Batch\Dto\ItemDto;

interface ItemFactoryInterface
{
    /**
     * @param ItemDto[] $itemDtos
     * @return Item[]
     */
    public function make(array $itemDtos);
}
