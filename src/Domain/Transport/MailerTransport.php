<?php

namespace Budgetcontrol\SdkMailer\Domain\Transport;

use Symfony\Component\Mailer\Transport\Dsn;
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
    private string $host;
    private string $username;
    private string $password;
    private int $port;
    private bool $tls = false;
    private ?\Psr\Log\LoggerInterface $logger;

    public function __construct(string $tls = 'false', int $port = 587, ?\Psr\Log\LoggerInterface $logger = null)
    {
        $this->port = $port;
        $this->tls = $tls === 'tls';
        $this->logger = $logger;

        parent::__construct();
    }

    protected function getSupportedSchemes(): array
    {
        return ['exchange','mailhog', 'aruba'];
    }

    /**
     * @throws UnsupportedSchemeException
     * @throws IncompleteDsnException
     */
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();
        $user = $this->getUser($dsn);
        $password = $this->getPassword($dsn);
        $host = 'default' === $dsn->getHost() ? null : $dsn->getHost();
        $sandbox = filter_var($dsn->getOption('sandbox', false), \FILTER_VALIDATE_BOOL);

        switch ($scheme) {
            case 'exchange':
                return new ExchangeSmtp($host, $user, $password, $this->port, $this->tls, null, $this->logger);
            case 'mailhog':
                return new MailhogSmtp($host, $user, $password, 1025, false);
            case 'aruba':
                return new ArubaSmtp($host, $user, $password, 465, 'tls', $this->logger);
        }


        throw new UnsupportedSchemeException($dsn, $scheme, $this->getSupportedSchemes());
    }



}
