<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory;

use Swift_Mailer as Mailer;
use Swift_SmtpTransport as Transport;
use Phalcon\Config;

class MailerFactory
{
    /** @var Config */
    private $technoparkConfig;

    public function __construct(Config $technoparkConfig)
    {
        $this->technoparkConfig = $technoparkConfig;
    }

    /** @return Mailer */
    public function getInstance()
    {
        $technoaprkMailerConfig = $this->technoparkConfig->path('mail')->toArray();

        $transport = (new Transport(
            $technoaprkMailerConfig['host'],
            $technoaprkMailerConfig['port']
        ));
        $transport->setPassword($technoaprkMailerConfig['password']);
        $transport->setUsername($technoaprkMailerConfig['user']);

        return new Mailer($transport);
    }
}
