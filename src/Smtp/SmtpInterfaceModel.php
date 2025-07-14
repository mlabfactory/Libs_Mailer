<?php declare(strict_types=1);
namespace MLAB\SdkMailer\Smtp;

interface SmtpInterfaceModel {

    public function getScheme(): string;
    public function getOptions(): array;
    public function getHost(): string;
    public function getPort(): int;
    public function getUsername(): string;
    public function getPassword(): string;
    public function getEncryption(): string;
    public function isTls(): bool;
    
}