<?php
namespace Budgetcontrol\SdkMailer\View;

interface ViewInterface
{
    public function view(): string;

    public function setTemplate(string $templateName): self;
}