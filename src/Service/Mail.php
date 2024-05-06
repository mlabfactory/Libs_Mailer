<?php

namespace Budgetcontrol\SdkMailer\Service;

use Symfony\Component\Mailer\Transport\Dsn;
use Budgetcontrol\SdkMailer\View\ViewInterface;

class Mail
{
    private string $driver = 'mailhog';
    private string $host = 'mailhog';
    private string $user = '';
    private string $password = '';
    private string $emailFromAddress;

    public function sendMail(array|string $emailTo, string $subject, ViewInterface $body, array $attachments = [], array $cc = [], array $bcc = []): void
    {
        $dsn = new Dsn($this->driver, $this->host, $this->user, $this->password);
        $emailService = new EmailService($dsn, $this->emailFromAddress);
        $emailService->sendEmail($emailTo, $subject, $body, $attachments, $cc, $bcc);
    }

    /**
     * Sets the driver for sending emails.
     *
     * @param string $driver The driver to set.
     * @return void
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * Sets the host for the email server.
     *
     * @param string $host The host to set.
     * @return void
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * Sets the username for authenticating with the email server.
     *
     * @param string $user The username to set.
     * @return void
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * Sets the password for authenticating with the email server.
     *
     * @param string $password The password to set.
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Sets the email address to send emails from.
     *
     * @param string $emailFromAddress The email address to set.
     * @return void
     */
    public function setEmailFromAddress(string $emailFromAddress): void
    {
        $this->emailFromAddress = $emailFromAddress;
    }
}
