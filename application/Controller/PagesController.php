<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Page;

class PagesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Pages";
        $Page = new Page();
        $current_page = "pages";
        $custom_js = URL."js/pages.js";
        $datatables = true;
        $pages = $Page->getAllPages();

        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/create
     */
    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create page";
        $Page = new Page();
        $current_page = "create-page";

        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/pages.js"
        );

        $pages = $Page->getAllPages();

        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addPage(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_page"])) {
            $params = array();
            parse_str($_POST["data_page"], $params);

            $Page = new Page();
            $result->response = $Page->addPage($params);
            $newpage = Helper::getLastRecord("pages");
            Helper::addLog("create-page", $session['user_id'], $newpage->id);
        }

        echo json_encode($result);
    }

    public function edit($page_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit page";
        $Page = new Page();
        $current_page = "pages";

        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/pages.js"
        );

        $pages = $Page->getAllPages();
        $page = $Page->getPage($page_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updatePage()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_page"]) AND isset($_POST["page_id"])) {
            $params = array();
            parse_str($_POST["data_page"], $params);
            $Page = new Page();
            $params['id'] = $_POST["page_id"];
            $result->response = $Page->updatePage($params);
            Helper::addLog("update-page", $session['user_id'], $_POST["page_id"]);

        }

        echo json_encode($result);
    }

    public function deletePage(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["page_id"])) {
            $Page = new Page();
            $pageInfo = $Page->getPage($_POST["page_id"]);
            $result->response = $Page->deletePage($_POST["page_id"]);
            Helper::addLog("delete-page", $session['user_id'], $pageInfo->page_name);
        }

        echo json_encode($result);
    }


}
