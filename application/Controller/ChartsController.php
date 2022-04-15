<?php

namespace Mini\Controller;

use Mini\Model\Song;

class ChartsController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        $current_page = "charts";

        require APP . 'view/_templates/header.php';
        require APP . 'view/charts/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/create
     */
    public function create()
    {
        $current_page = "animal-data";

        require APP . 'view/_templates/header.php';
        require APP . 'view/charts/create.php';
        require APP . 'view/_templates/footer.php';
    }


}
