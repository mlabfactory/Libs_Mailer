<?php

namespace Budgetcontrol\SdkMailer\Domain\Transport;

use Psr\Log\LoggerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailhogSmtp extends EsmtpTransport 
{

    public function __construct(string $host, string $username, #[\SensitiveParameter] string $password, int $port, bool $tls = false, ?EventDispatcherInterface $dispatcher = null, ?LoggerInterface $logger = null)
    {
        parent::__construct($host, $port, $tls, $dispatcher, $logger);

        $this->setUsername($username);
        $this->setPassword($password);
    }

}
