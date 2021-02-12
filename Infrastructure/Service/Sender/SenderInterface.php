<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender;

use Swift_Message as Message;

interface SenderInterface
{
    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message);
}
