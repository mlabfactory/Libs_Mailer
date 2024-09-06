<?php

namespace MLAB\SdkMailer\View\Render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use MLAB\SdkMailer\View\ViewInterface;
use MLAB\SdkMailer\Exception\ViewRenderException;

class View implements ViewInterface
{
    protected string $dirPath = __DIR__ . '/../../../resources/Templates/';
    private Environment $twig;
    protected string $templateName = 'base.twig';

    /**
     * Constructs a new View object.
     *
     * @param string|null $dirPath The directory path for the view files. Defaults to null.
     * @param string|null $cachePath The directory path for the cached view files. Defaults to null.
     */
    public function __construct(?string $dirPath = null, ?string $cachePath = null)
    {
        if (is_null($dirPath)) {
            $this->dirPath = $dirPath;
        }

        $options = [];
        if (!is_null($cachePath)) {
            $options['cache'] = $cachePath;
        }

        $loader = new FilesystemLoader($this->dirPath);
        $this->twig = new Environment($loader,$options);
    }

    /**
     * Returns the rendered view as a string.
     *
     * @return string The rendered view.
     */
    public function view(): string
    {
        return $this->render();
    }

    /**
     * Renders the view with the given data.
     *
     * @param array $data The data to be passed to the view.
     * @return string The rendered view as a string.
     */
    public function render(array $data = []): string
    {
        $this->validate();
        return $this->twig->render($this->templateName, $data);
    }

    /**
     * Validates the view.
     *
     * @return void
     */
    private function validate()
    {
        if (!$this->twig->getLoader()->exists($this->templateName)) {
            throw new ViewRenderException("Template file {$this->templateName} does not exist.");
        }

        if (!str_ends_with($this->templateName, '.twig')) {
            throw new ViewRenderException("Template file must have a .twig extension");
        }
    }

    /**
     * Sets the template name for the view.
     *
     * @param string $templateName The name of the template.
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
}
