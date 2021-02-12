<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message;

class OrderInIssueStatusMessage
{
    /** @var string */
    private $externalOrderId;

    /** @var int */
    private $publicOrderId;

    /**
     * @param int $publicOrderId
     * @param string $externalOrderId
     */
    public function __construct($publicOrderId, $externalOrderId)
    {
        $this->publicOrderId = $publicOrderId;
        $this->externalOrderId = $externalOrderId;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return sprintf('Заказ %s - %s в состоянии спора', $this->publicOrderId, $this->externalOrderId);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return sprintf(
            'Заказ %s - %s находится в состоянии спора. Требуется решить проблему покупателя в кратчайшие сроки.',
            $this->publicOrderId,
            $this->externalOrderId
        );
    }
}
