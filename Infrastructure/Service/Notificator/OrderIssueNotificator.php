<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\OrderIssueNotificatorInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Order;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory\OrderIssueNotificationFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory\AttachmentFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory\MessageFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\SenderInterface;

class OrderIssueNotificator implements OrderIssueNotificatorInterface
{
    /** @var OrderIssueNotificationFactoryInterface */
    private $notificationFactory;

    /** @var AttachmentFactoryInterface */
    private $attachmentFactory;

    /** @var MessageFactoryInterface */
    private $messageFactory;

    /** @var SenderInterface */
    private $emailSender;

    public function __construct(
        AttachmentFactoryInterface $attachmentFactory,
        MessageFactoryInterface $messageFactory,
        SenderInterface $emailSender,
        OrderIssueNotificationFactoryInterface $notificationFactory
    ) {
        $this->attachmentFactory = $attachmentFactory;
        $this->messageFactory = $messageFactory;
        $this->notificationFactory = $notificationFactory;
        $this->emailSender = $emailSender;
    }

    /**
     * @inheritDoc
     */
    public function notify(Order $order, AbstractType $issueType)
    {
        $notification = $this->notificationFactory->make($order, $issueType);
        $attachment = $this->attachmentFactory->getAttachmentFromData(
            'order_aliexpress.json',
            $notification->getAttachment(),
            'application/json'
        );
        $message = $this->messageFactory->getMessage($notification, $attachment);
        $this->emailSender->send($message);

        return $notification;
    }
}
