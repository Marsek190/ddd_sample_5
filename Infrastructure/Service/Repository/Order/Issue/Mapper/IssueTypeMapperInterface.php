<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Mapper;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;

interface IssueTypeMapperInterface
{
    /**
     * @param string $code
     * @return AbstractType|null
     */
    public function getTypeByCode($code);

    /**
     * @param AbstractType $type
     * @return string
     */
    public function getTypeCode(AbstractType $type);
}
