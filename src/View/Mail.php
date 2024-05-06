<?php
namespace Budgetcontrol\SdkMailer\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Mail extends Render\View implements ViewInterface
{
    private array $data;
    protected string $templateName = 'parts/custom.twig';

    /**
     * Constructor for the Mail class.
     *
     * @param array $data An array of data to be passed to the Mail object. ( simple_message, message )
     */
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