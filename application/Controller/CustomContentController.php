<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\CustomContent;

class CustomContentController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Custom Content";
        $CustomContent = new CustomContent();
        $current_page = "custom-content";
        $custom_js = URL."js/custom-content.js";

        $datatables = true;
        $customContent = $CustomContent->getAllCustomContent();

        require APP . 'view/_templates/header.php';
        require APP . 'view/custom-content/index.php';
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
        $title = "Create Custom Content";
        $CustomContent = new CustomContent();
        $current_page = "custom-content";
        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/custom-content.js"
        );

        $customContent = $CustomContent->getAllCustomContent();

        require APP . 'view/_templates/header.php';
        require APP . 'view/custom-content/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addCustomContent(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_custom_content"])) {
            $params = array();
            parse_str($_POST["data_custom_content"], $params);

            $CustomContent = new CustomContent();
            $result->response = $CustomContent->addCustomContent($params);
            $newCustomContent = Helper::getLastRecord("custom-content");
            Helper::addLog("create-custom-content", $session['user_id'], $newCustomContent->id);
        }

        echo json_encode($result);
    }

    public function edit($custom_content_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit custom content";
        $CustomContent = new CustomContent();
        $current_page = "custom-content";
        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/custom-content.js"
        );
        $customContents = $CustomContent->getAllCustomContent();
        $customContent = $CustomContent->getCustomContent($custom_content_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/custom-content/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateCustomContent()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_custom_content"]) AND isset($_POST["custom_content_id"])) {
            $params = array();
            parse_str($_POST["data_custom_content"], $params);
            $CustomContent = new CustomContent();
            $params['id'] = $_POST["custom_content_id"];
            $result->response = $CustomContent->updateCustomContent($params);
            Helper::addLog("update-custom-content", $session['user_id'], $_POST["custom_content_id"]);
        }

        echo json_encode($result);
    }

    public function deleteCustomContent(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["custom_content_id"])) {
            $CustomContent = new CustomContent();
            $customContentInfo = $CustomContent->getCustomContent($_POST["custom_content_id"]);
            $result->response = $CustomContent->deleteCustomContent($_POST["custom_content_id"]);
            Helper::addLog("delete-custom-content", $session['user_id'], $customContentInfo->name);
        }

        echo json_encode($result);
    }
}
