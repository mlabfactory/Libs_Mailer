<?php

declare(strict_types=1);

namespace MLAB\SdkMailer\Smtp;

final class Mailhog implements SmtpInterfaceModel
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $encryption;
    private array $options = [];
    private string $scheme = 'smtp';

    public function __construct(string $host = 'localhost', int $port = 1025, string $username = 'user', #[\SensitiveParameter] string $password = 'password', string $encryption = 'tls', array $options = [])
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->encryption = $encryption;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEncryption(): string
    {
        return $this->encryption;
    }

    public function isTls(): bool
    {
        return $this->getEncryption() === 'tls';
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
