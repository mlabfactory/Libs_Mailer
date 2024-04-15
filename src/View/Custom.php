<?php
namespace Budgetcontrol\SdkMailer\View;

class Custom extends Render\Views implements ViewInterface {

    private array $data;

    public function __construct(string $templatePath, array $data = []) {
        
        $this->templateName = $templatePath;
        if(!file_exists($this->dirPath.$this->templateName)) {
            throw new ViewRenderExceptions("File doesn't exist on path ".$this->dirPath.$this->templateName);
        }

        $this->data = $data;
        
    }

    public function view(): string 
    {
        $this->render($this->data);
    }

}