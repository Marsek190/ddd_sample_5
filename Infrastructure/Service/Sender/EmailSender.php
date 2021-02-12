<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender;

use Swift_Mailer as Mailer;
use Swift_Message as Message;

class EmailSender implements SenderInterface
{
    /** @var Mailer */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /** @inheritDoc */
    public function send(Message $message)
    {
        $this->mailer->send($message);
    }
}
