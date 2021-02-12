<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory;

use Swift_Message as Message;
use Swift_Attachment as Attachment;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Notification;

interface MessageFactoryInterface
{
    /**
     * @param Notification $notification
     * @param Attachment $attachment
     * @return Message
     */
    public function getMessage(Notification $notification, Attachment $attachment);
}
