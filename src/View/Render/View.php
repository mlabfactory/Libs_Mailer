<?php

namespace MLAB\SdkMailer\View\Render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use MLAB\SdkMailer\View\ViewInterface;

class View implements ViewInterface
{
    protected string $dirPath;
    private Environment $twig;
    protected string $templateName = 'base.twig';
    protected array $data = [];

    /**
     * Constructs a new View object.
     *
     * @param string $dirPath The directory path for the view files. Defaults to null.
     * @param string|null $cachePath The directory path for the cached view files. Defaults to null.
     */
    public function __construct(string $dirPath = __DIR__ . '/../../../resources/Templates/', ?string $cachePath = null)
    {
        $this->dirPath = $dirPath;
        $options = [];
        if (!is_null($cachePath)) {
            $options['cache'] = $cachePath;
        }

        $loader = new FilesystemLoader($this->dirPath);
        $this->twig = new Environment($loader,$options);
    }

    public function view(): string
    {
        return $this->render();
    }

    /**
     * Renders the view with the given data.
     *
     * @return string The rendered view as a string.
     */
    public function render(): string
    {
        return $this->twig->render($this->templateName, $this->data);
    }

    /**
     * Sets the template name for the view.
     *
     * @param string $templateName The name of the template without dir path.
     * @return void
     */
    public function setTemplate(string $templateName): self
    {
        if (!str_ends_with($templateName, '.twig')) {
            $templateName .= '.twig';
        }
        $this->templateName = $templateName;
        return $this;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}
