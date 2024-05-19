<?php

namespace MLAB\SdkMailer\Service;

use Symfony\Component\Mailer\Transport\Dsn;
use MLAB\SdkMailer\View\ViewInterface;
use MLAB\SdkMailer\Domain\Transport\MailerTransport;
use MLAB\SdkMailer\Service\MailerClientService;

class EmailService
{
    private Dsn $dsn;
    private string $from;

    /**
     * EmailService constructor.
     *
     * @param Dsn $dsn The DSN object representing the email service configuration. Example: new Dsn('mailhog', 'mailhog', '','');
     */
    public function __construct(Dsn $dsn, string $from)
    {
        $this->dsn = $dsn;
        $this->from = $from;
    }

    /**
     * Sends an email.
     *
     * @param array|string $to The recipient's email address.
     * @param string $subject The subject of the email.
     * @param ViewInterface $body The body of the email.
     * @param array $attachments An optional array of file paths to attach to the email.
     * @param array $cc An optional array of email addresses to CC.
     * @param array $bcc An optional array of email addresses to BCC.
     * @return bool Returns true if the email was sent successfully, false otherwise.
     */
    public function sendEmail(array|string $to, string $subject, ViewInterface $body, array $attachments = [], array $cc = [], array $bcc = []): bool
    {
        $transport = new MailerTransport();
        $dsn = $this->dsn;

        $mailerService = new MailerClientService($this->from, new \Symfony\Component\Mailer\Mailer($transport->create($dsn)));

        foreach ($attachments as $attachment) {
            $mailerService->addAttachment($attachment);
        }

        foreach ($cc as $email) {
            $mailerService->addCc($email);
        }

        foreach ($bcc as $email) {
            $mailerService->addBcc($email);
        }

        if(is_array($to)) {
            $to = implode(',', $to);
        }

        // Send email
        return $mailerService->setBody($body)->send($to, $subject);
    }
}
