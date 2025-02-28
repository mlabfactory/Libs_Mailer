<?php
namespace MLAB\SdkMailer\View;

interface ViewInterface
{
    /**
     * Renders the view and returns the output as a string.
     *
     * @return string The rendered view output.
     */
    public function render(): string;

    /**
     * Sets the template name for the view.
     *
     * @param string $templateName The name of the template.
     * @return void
     */
    public function setTemplate(string $templateName): self;

    /**
     * Sets the data for the view.
     *
     * @param mixed $data The data to be set.
     * @return self Returns the instance of the implementing class.
     */
    public function setData($data): self;
}