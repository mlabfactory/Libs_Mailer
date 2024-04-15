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

    public function __construct()
    {
        $this->host = env('MAIL_HOST');
        $this->username = env('MAIL_USERNAME');
        $this->password = env('MAIL_PASSWORD');
        $this->port = env('MAIL_PORT', 587);
        $this->tls = env('MAIL_ENCRYPTION', 'tls') === 'tls';

        parent::__construct();
    }

    protected function getSupportedSchemes(): array
    {
        return ['exchange','mailhog'];
    }

    /**
     * @throws UnsupportedSchemeException
     * @throws IncompleteDsnException
     */
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();
        $user = empty($this->getUser($dsn)) ? $this->username : $this->getUser($dsn);
        $password = empty($this->getPassword($dsn)) ? $this->password : $this->getPassword($dsn);
        $host = 'default' === $dsn->getHost() ? null : $dsn->getHost();
        $sandbox = filter_var($dsn->getOption('sandbox', false), \FILTER_VALIDATE_BOOL);

        switch ($scheme) {
            case 'exchange':
                return new ExchangeSmtp($host, $user, $password, $this->port, $this->tls, $this->dispatcher, $this->logger);
            case 'mailhog':
                return new MailhogSmtp($host, $user, $password, 1025, false);
        }


        throw new UnsupportedSchemeException($dsn, $scheme, $this->getSupportedSchemes());
    }



}
