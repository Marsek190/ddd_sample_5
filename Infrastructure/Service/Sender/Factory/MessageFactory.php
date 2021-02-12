<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory;

use Swift_Message as Message;
use Swift_Attachment as Attachment;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;

class MessageFactory implements MessageFactoryInterface
{
    /** @inheritDoc */
    public function getMessage(Notification $notification, Attachment $attachment)
    {
        $message = (new Message())
            ->setSubject($notification->getTheme())
            ->setFrom(['noreply@post.technopark.ru' => 'ТЕХНОПАРК Интернет магазин'])
            ->setTo($notification->getAddresses())
            ->attach($attachment);

        if (!empty($notification->getDescription())) {
            $message->setBody($notification->getDescription(), 'text/html');
        }

        return $message;
    }
}
