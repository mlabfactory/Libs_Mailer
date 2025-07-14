<?php

namespace MLAB\SdkMailer\Domain\Transport;

use Monolog\Logger;
use Symfony\Component\Mailer\Transport\Dsn;
use MLAB\SdkMailer\Service\TransportSmtpService;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mailer\Transport\AbstractTransportFactory;
use Symfony\Component\Mailer\Exception\UnsupportedSchemeException;

/**
 * Interface MailProviderInterface
 * 
 * This interface defines the contract for a mail provider.
 * A mail provider is responsible for sending emails.
 */

class MailerTransport extends AbstractTransportFactory
{
    private int $port;
    private bool $tls = false;
    protected ?\Psr\Log\LoggerInterface $logger;

    public function __construct(string $tls = 'false', int $port = 587)
    {
        $this->port = $port;
        $this->tls = $tls === 'tls';
        $this->logger = new Logger('mailer');

        parent::__construct();
    }

    protected function getSupportedSchemes(): array
    {
        return ['smtp', 'smtps'];
    }

    /**
     * @throws UnsupportedSchemeException
     * @throws IncompleteDsnException
     */
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();

        if(!in_array($scheme, $this->getSupportedSchemes(), true)) {
            throw new UnsupportedSchemeException($dsn, sprintf('The "%s" scheme is not supported; supported schemes are: "%s".', $scheme, implode('", "', $this->getSupportedSchemes())));
        }

        return new TransportSmtpService($dsn);

    }



}
