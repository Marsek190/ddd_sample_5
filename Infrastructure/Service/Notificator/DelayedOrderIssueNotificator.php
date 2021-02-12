<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DelayedOrderIssueNotificatorInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter\ExporterInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Notificator\Factory\DelayedOrderIssueNotificationFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory\AttachmentFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory\MessageFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\SenderInterface;

class DelayedOrderIssueNotificator implements DelayedOrderIssueNotificatorInterface
{
    /** @var AttachmentFactoryInterface */
    private $attachmentFactory;

    /** @var MessageFactoryInterface */
    private $messageFactory;

    /** @var SenderInterface */
    private $emailSender;

    /** @var DelayedOrderIssueNotificationFactoryInterface */
    private $notificationFactory;

    /** @var ExporterInterface */
    private $exporter;

    public function __construct(
        AttachmentFactoryInterface $attachmentFactory,
        MessageFactoryInterface $messageFactory,
        SenderInterface $emailSender,
        DelayedOrderIssueNotificationFactoryInterface $notificationFactory,
        ExporterInterface $exporter
    ) {
        $this->attachmentFactory = $attachmentFactory;
        $this->messageFactory = $messageFactory;
        $this->emailSender = $emailSender;
        $this->notificationFactory = $notificationFactory;
        $this->exporter = $exporter;
    }

    /**
     * @inheritDoc
     */
    public function notify(array $splitedIssues)
    {
        $tmpHandler = $this->exporter->export($splitedIssues);
        $notification = $this->notificationFactory->make();
        $attachment = $this->attachmentFactory->getAttachmentFromData(
            'delayed.xlsx',
            $tmpHandler->getContent(),
            'application/csv'
        );
        $message = $this->messageFactory->getMessage($notification, $attachment);

        $this->emailSender->send($message);
        $tmpHandler->remove();
    }
}
