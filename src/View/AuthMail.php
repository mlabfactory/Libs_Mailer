<?php
namespace Budgetcontrol\SdkMailer\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AuthMail extends Render\Views implements ViewInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function view():string
    {
        return $this->render($this->data);
    }

    public function sign_upView()
    {
        $this->templateName = '/parts/auth/sign-up.twig';
        return $this->view();
    }

    public function recovery_passwordView()
    {
        $this->templateName = '/parts/auth/recovery-password.twig';
        return $this->view();
    }

}