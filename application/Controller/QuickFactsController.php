<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Song;

class QuickFactsController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $current_page = "quick-facts";

        require APP . 'view/_templates/header.php';
        require APP . 'view/quick-facts/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
