<?php
namespace MLAB\SdkMailer\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Mail extends Render\View implements ViewInterface
{
    protected string $templateName = 'parts/custom.twig';

    public function view():string
    {
        return $this->render();
    }

}