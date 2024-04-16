<?php
namespace Budgetcontrol\SdkMailer\Exception;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ExchangeTransportValidation extends \Exception implements TransportExceptionInterface
{
    public function __construct($message = 'Error setting email parameters you must specify env varialbe [MAIL_HOST]', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getDebug(): string
    {
        //FIXME: Implement getDebug() method.
        // Add implementation here
        return '';
    }

    public function appendDebug(string $debug): void
    {
        //FIXME: Implement appendDebug() method.
        // Add implementation here
    }
    
}