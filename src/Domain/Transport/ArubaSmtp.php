<?php

namespace Budgetcontrol\SdkMailer\Domain\Transport;

use Psr\Log\LoggerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class ArubaSmtp extends EsmtpTransport 
{

    public function __construct(string $host, string $username, #[\SensitiveParameter] string $password, int $port = 465, string $tls = 'tls', ?LoggerInterface $logger = null)
    {
        parent::__construct($host, $port, $tls, null, $logger);

        $this->setUsername($username);
        $this->setPassword($password);
    }

}
