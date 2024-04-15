<?php

namespace Budgetcontrol\SdkMailer\Service;

use Symfony\Component\Mailer\Transport\Dsn;
use Budgetcontrol\SdkMailer\Mailer\Service\MailerClientService;
use Budgetcontrol\SdkMailer\Mailer\Domain\Transport\MailerTransport;

class EmailService
{
    private Dsn $dsn;

    /**
     * EmailService constructor.
     *
     * @param Dsn $dsn The DSN object representing the email service configuration. Example: new Dsn('mailhog', 'mailhog', '','');
     */
    public function __construct(Dsn $dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * Sends an email.
     *
     * @param string $to The recipient's email address.
     * @param string $subject The subject of the email.
     * @param EmailViewInterface $body The body of the email.
     * @param array $attachments An optional array of file paths to attach to the email.
     * @param array $cc An optional array of email addresses to CC.
     * @param array $bcc An optional array of email addresses to BCC.
     * @return bool Returns true if the email was sent successfully, false otherwise.
     */
    public function sendEmail(string $to, string $subject, ViewInterface $body, array $attachments = [], array $cc = [], array $bcc = []): bool
    {
        $transport = new MailerTransport();
        $dsn = $this->dsn;

        $mailerService = new MailerClientService(env('MAIL_FROM'), new \Symfony\Component\Mailer\Mailer($transport->create($dsn)));

        foreach ($attachments as $attachment) {
            $mailerService->addAttachment($attachment);
        }

        foreach ($cc as $email) {
            $mailerService->addCc($email);
        }

        foreach ($bcc as $email) {
            $mailerService->addBcc($email);
        }

        // Send email
        return $mailerService->setBody($body)->send($to, $subject);
    }
}
