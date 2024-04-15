<?php
namespace MLAB\SimpleWebSite\View\Render;

use Exception;

class ViewRenderException extends Exception {

    // Personalizza la tua eccezione, se necessario
    public function __construct($message = "Templane file must have .twig in extension") {
        parent::__construct($message, 500);
    }

}