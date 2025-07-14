<?php

namespace MLAB\SdkMailer\Service;

use MLAB\SdkMailer\Smtp\SmtpInterfaceModel;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class TransportSmtpService extends EsmtpTransport 
{

    public function __construct(Dsn $dsn)
    {
        $host = $dsn->getHost();
        $port = $dsn->getPort();
        $tls = $dsn->getScheme() === 'smtps';
        $logger = null;

        parent::__construct($host, $port, $tls, null, $logger);

        $this->setUsername($dsn->getUser());
        $this->setPassword($dsn->getPassword());
    }

}
