<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message;

class InvalidFiasLevelMessage
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
        return sprintf('Недостаточный уровень ФИАС по заказу %s', $this->externalOrderId);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return sprintf(
            'Адрес в заказе %s указан недостаточно точно. Для осуществления доставки адрес должен быть указан с точностью до улицы.',
            $this->externalOrderId
        );
    }
}
