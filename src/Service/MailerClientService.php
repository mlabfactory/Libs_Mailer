<?php

namespace MLAB\SdkMailer\Service;

use Symfony\Component\Mime\Email;
use MLAB\SdkMailer\Logger\Application\Log\Log;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Exception\TransportException;
use MLAB\SdkMailer\View\ViewInterface;
use MLAB\SdkMailer\Exception\MailServiceException;

/**
 *  mailer service client
 *  @package composer require symfony/mailer
 */


class MailerClientService
{

    private $isHtmlEmail;
    private Email $email;
    private Mailer $mailer;
    private Address $from;

    public function __construct( $from, Mailer $mailer, bool $isHtmlEmail = true)
    {
        $this->email = new Email();
        $this->isHtmlEmail = $isHtmlEmail;
        $this->mailer = $mailer;
        $this->from = Address::create($from);
    }

    /**
     * Sends an email.
     *
     * @param array $to The recipient's email address.
     * @param string $subject The subject of the email.
     * @return bool Returns true if the email was sent successfully, false otherwise.
     * @throws MailServiceException
     */
    public function send(array $to, string $subject): bool
    {
        $this->email->from($this->from)
        ->subject($subject);

        foreach ($to as $email) {
            $this->email->addTo($this->address($email));
        }

        try {
            $this->mailer->send($this->email);
            return true;
        } catch (TransportException $e) {
            throw new MailServiceException('Error setting email parameters');
        }

        return false;

    }


    /**
     * Sets the attachments for the mailer client service.
     *
     * @param array|string $attachments An array of attachments to be added. <path,name>
     * @return self
     */
    public function addAttachment(array|string $attachment): self
    { 
        if(is_string($attachment)) {
            $_attachment['name'] = basename($attachment);
            $_attachment['path'] = $attachment;
            $attachment = $_attachment;
            if(!file_exists($attachment['path'])) {
                throw new MailServiceException('Attachment file not found', 500);
            }
        }   

        if(!file_exists($attachment['path'])) {
            throw new \Exception('Attachment file not found');
        }

        $this->email->attachFromPath($attachment['path'], $attachment['name']);


        return $this;
    }

    
    /**
     * Sets the CC recipients for the email.
     *
     * @param array|stirng $cc An array containing the email and name of the CC recipient.  <email,name>
     * @return self Returns the current instance of the MailerClientService.
     */
    public function addCc(array|string $cc): self
    {
        $this->email->addCc($this->address($cc));

        return $this;
    }

    /**
     * Sets the blind carbon copy (BCC) recipients for the email.
     *
     * @param array|string $bcc An array of email addresses to set as BCC recipients. <email,name>
     * @return self Returns the current instance of the MailerClientService.
     */
    public function addBcc(array|string $bcc): self
    {
        $this->email->addBcc($this->address($bcc));

        return $this;
    }

    /**
     * Sets the reply-to address for the email.
     *
     * @param array|string $replyTo An array containing the email and name of the reply-to recipient. <email,name>
     * @return self Returns the current instance of the MailerClientService.
     */
    public function setReplyTo(array|string $replyTo): self
    {
        $this->email->replyTo($this->address($replyTo));

        return $this;
    }

    /**
     * Sets the email body.
     *
     * @param ViewInterface $body The body of the email.
     * @return self Returns the current instance of the MailerClientService.
     */
    public function setBody(ViewInterface $body): self
    {
        $this->email->html($body->view());

        return $this;
    }

    private function address(string|array $address): Address 
    {
        if(is_string($address)) {
            return new Address($address);
        }

        return new Address($address['email'], $address['name']);
    }
}
