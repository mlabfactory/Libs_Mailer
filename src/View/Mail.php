<?php
namespace Budgetcontrol\SdkMailer\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Mail extends Render\View implements ViewInterface
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

}