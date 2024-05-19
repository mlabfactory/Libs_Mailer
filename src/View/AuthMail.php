<?php
namespace MLAB\SdkMailer\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AuthMail extends Render\View implements ViewInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct();
    }

    public function view():string
    {
        return $this->render($this->data);
    }

    public function sign_upView()
    {
        $this->templateName = '/parts/auth/sign-up.twig';
    }

    public function recovery_passwordView()
    {
        $this->templateName = '/parts/auth/recovery-password.twig';
    }


}