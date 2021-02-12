<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message;

class OrderInCancelStatusMessage
{
    /** @var string */
    private $externalOrderId;

    /**
     * @param string $externalOrderId
     */
    public function __construct($externalOrderId)
    {
        $this->externalOrderId = $externalOrderId;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return sprintf('Покупатель запросил отмену заказа (IN_CANCEL) %s', $this->externalOrderId);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return sprintf(
            'Покупатель запросил отмену заказа %s. Требуется уточнить статус заказа у Технопарк и, в случае согласования - Отменить заказ.',
            $this->externalOrderId
        );
    }
}
