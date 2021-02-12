<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Mapper;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\IssueTypeFactoryInterface;

class IssueTypeMapper implements IssueTypeMapperInterface
{
    /** @var IssueTypeFactoryInterface */
    private $issueTypeFactory;

    /** @var array */
    private $codeToClassMap;

    public function __construct(IssueTypeFactoryInterface $issueTypeFactory)
    {
        $this->issueTypeFactory = $issueTypeFactory;
        $this->codeToClassMap = $this->getMap();
    }

    /**
     * @inheritDoc
     */
    public function getTypeByCode($code)
    {
        $class = isset($this->codeToClassMap[$code]) ? $this->codeToClassMap[$code] : null;
        switch ($class) {
            case InvalidFiasLevelType::class:
                return $this->issueTypeFactory->getInvalidFiasLevelType();
            case ProductUnavailabilityType::class:
                return $this->issueTypeFactory->getProductUnavailabilityType();
            case OrderInCancelStatusType::class:
                return $this->issueTypeFactory->getOrderInCancelStatusType();
            case OrderInIssueStatusType::class:
                return $this->issueTypeFactory->getOrderInIssueStatusType();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getTypeCode(AbstractType $type)
    {
        $class = get_class($type);
        $classToCodeMap = array_flip($this->codeToClassMap);

        return isset($classToCodeMap[$class]) ? $classToCodeMap[$class] : null;
    }

    /**
     * @return array
     */
    private function getMap()
    {
        return [
            'invalid_fias_level' => InvalidFiasLevelType::class,
            'unavailable_product_in_order' => ProductUnavailabilityType::class,
            'order_in_cancel_status' => OrderInCancelStatusType::class,
            'order_in_issue_status' => OrderInIssueStatusType::class,
        ];
    }
}
