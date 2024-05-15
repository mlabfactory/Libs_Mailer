<?php
namespace Budgetcontrol\SdkMailer\View;

use Budgetcontrol\SdkMailer\View\Render\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Mail extends Render\View implements ViewInterface
{
    protected string $templateName = 'parts/custom.twig';
    protected array $data = [];

    public function view():string
    {
        return $this->render();
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setTemplate(string $templateName): self
    {
        $this->templateName = $templateName;
        return $this;
    }

}