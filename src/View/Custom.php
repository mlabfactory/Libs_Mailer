<?php
namespace Budgetcontrol\SdkMailer\View;

use Budgetcontrol\SdkMailer\Exception\ViewRenderException;

class Custom extends Render\View implements ViewInterface {

    private array $data;

    public function __construct(string $templatePath, array $data = []) {
        
        $this->templateName = $templatePath;
        if(!file_exists($this->dirPath.$this->templateName)) {
            throw new ViewRenderException("File doesn't exist on path ".$this->dirPath.$this->templateName);
        }

        $this->data = $data;
        parent::__construct();
        
    }

    public function view(): string 
    {
        return $this->render($this->data);
    }

}