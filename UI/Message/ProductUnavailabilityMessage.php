<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message;

class ProductUnavailabilityMessage
{
    /** @var int */
    private $externalOrderId;

    /** @var string */
    private $productNamesConcat;

    /**
     * @param int $externalOrderId
     * @param string $productNamesConcat
     */
    public function __construct($externalOrderId, $productNamesConcat)
    {
        $this->externalOrderId = $externalOrderId;
        $this->productNamesConcat = $productNamesConcat;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return sprintf('Отсутствует товар по заказу %s', $this->externalOrderId);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return sprintf(
            'Товар(ы) %s по заказу %s недоступен(недоступны). Требуется связаться с клиентом и отменить заказ.',
            $this->productNamesConcat,
            $this->externalOrderId
        );
    }
}
