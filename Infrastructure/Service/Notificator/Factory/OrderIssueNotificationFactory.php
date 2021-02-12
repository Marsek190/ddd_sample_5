<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\InvalidFiasLevelType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInCancelStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\OrderInIssueStatusType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\ProductUnavailabilityType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Product\ProductManagerInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message\InvalidFiasLevelMessage;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message\OrderInCancelStatusMessage;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message\OrderInIssueStatusMessage;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\UI\Message\ProductUnavailabilityMessage;

class OrderIssueNotificationFactory implements OrderIssueNotificationFactoryInterface
{
    /** @var ProductManagerInterface */
    private $productManager;

    private $addresses = [
        'project+19252@mrdom.planfix.ru',
    ];

    public function __construct(ProductManagerInterface $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * @inheritDoc
     */
    public function make(Order $order, AbstractType $issueType)
    {
        switch (get_class($issueType)) {
            case InvalidFiasLevelType::class:
                $message = new InvalidFiasLevelMessage($order->id);

                $theme = $message->getTheme();
                $description = $message->getDescription();
                break;
            case OrderInCancelStatusType::class:
                $message = new OrderInCancelStatusMessage($order->id);

                $theme = $message->getTheme();
                $description = $message->getDescription();
                break;
            case OrderInIssueStatusType::class:
                $message = new OrderInIssueStatusMessage($order->publicId, $order->id);

                $theme = $message->getTheme();
                $description = $message->getDescription();
                break;
            case ProductUnavailabilityType::class:
                $message = new ProductUnavailabilityMessage(
                    $order->id,
                    implode(',', $this->productManager->getUnavailableProductNames($order->items))
                );

                $theme = $message->getTheme();
                $description = $message->getDescription();
                break;
            default:
                return null;
        }

        return new Notification($theme, $description, $this->addresses, $this->getAttachment($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    private function getAttachment(Order $order)
    {
        return json_encode($order->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
