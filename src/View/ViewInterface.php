<?php
namespace MLAB\SdkMailer\View;

interface ViewInterface
{
    public function view(): string;

    /**
     * Sets the template name for the view.
     *
     * @param string $templateName The name of the template.
     * @return void
     */
    public function setTemplate(string $templateName): self;
}