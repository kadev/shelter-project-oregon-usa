<?php

namespace Mini\Controller;

use Mini\Model\Song;

class ParameterController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        $current_page = "parameters";

        require APP . 'view/_templates/header.php';
        require APP . 'view/parameters/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
