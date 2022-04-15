<?php

namespace Mini\Controller;

//use Mini\Libs\FancyFileUploaderHelper;
use Mini\Libs\Helper;
use Mini\Model\Article;

class ArticlesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Articles";
        $Article = new Article();
        $current_page = "articles";
        $custom_js = URL."js/articles.js";
        $datatables = true;

        $articles = $Article->getAllArticles();

        require APP . 'view/_templates/header.php';
        require APP . 'view/articles/index.php';
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
        $title = "Create article";
        $current_page = "create-article";
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/articles.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/articles/create.php';
        require APP . 'view/_templates/footer.php';

    }

    public function addArticle(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_article"])) {
            $params = array();
            parse_str($_POST["data_article"], $params);

            $Article = new Article();
            $newarticle = $Article->getLastRecord();
            $result->response = $Article->addArticle($params);
            Helper::addLog("create-article", $session['user_id'], $newarticle->id);
        }

        echo json_encode($result);
    }

    public function edit($article_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit article";
        $Article = new Article();
        $current_page = "articles";
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/articles.js"
        );

        $article = $Article->getArticle($article_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/articles/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateArticle()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_article"]) AND isset($_POST["article_id"])) {
            $params = array();
            parse_str($_POST["data_article"], $params);
            $Article = new Article();
            $params['id'] = $_POST["article_id"];
            $result->response = $Article->updateArticle($params);
            Helper::addLog("update-article", $session['user_id'], $_POST["article_id"]);

        }

        echo json_encode($result);
    }

    public function uploadArticleImage(){
        require_once APP."Libs/FancyFileUploaderHelper.php";

        //if (isset($_REQUEST["action"]) && $_REQUEST["action"] === "fileuploader") {
            header("Content-Type: application/json");

            $allowedexts = array("jpg" => true, "png" => true,);

            $files = FancyFileUploaderHelper::NormalizeFiles("files");

            if (!isset($files[0]))  $result = array("success" => false, "error" => "File data was submitted but is missing.", "errorcode" => "bad_input");
            else if (!$files[0]["success"])  $result = $files[0];
            else if (!isset($allowedexts[strtolower($files[0]["ext"])])) {
                $result = array(
                    "success" => false,
                    "error" => "Invalid file extension.  Must be '.jpg' or '.png'.",
                    "errorcode" => "invalid_file_ext"
                );
            }
            else
            {
                // For chunked file uploads, get the current filename and starting position from the incoming headers.
                $name = FancyFileUploaderHelper::GetChunkFilename();
                if ($name !== false) {
                    $startpos = FancyFileUploaderHelper::GetFileStartPosition();
                }
                else {
                    // [Do stuff with the file here.]
                    $tname = explode(".", $files[0]["name"]);
                    $tname = $tname[0].".".time().'.'.$files[0]["ext"];

                    copy($files[0]["file"], __DIR__ . "/../../public/uploads/" . strtolower($tname));
                }

                $result = array(
                    "success" => true,
                    "filename" => $tname
                );
            }

            echo json_encode($result, JSON_UNESCAPED_SLASHES);
            exit();
        //}
    }

    public function removeImageArticle(){
        $result = new \stdClass();
        $result->response = false;
        $Article = new Article();

        if (isset($_POST["image_article"])) {
            $filename = $_POST["image_article"];
            $PATHFILE = ROOT . 'public/uploads/'.$filename;
            $result->pathfile = $PATHFILE;
            if (file_exists($PATHFILE)) {
                $result->response = unlink($PATHFILE);
                if($result->response == true AND isset($_POST['article_id'])){
                    $Article->clearImageColumn($_POST['article_id']);
                }
            } else {
                $result->response = false;
            }
        }

        echo json_encode($result);
    }

    public function deleteArticle(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["article_id"])) {
            $Article = new Article();
            $articleInfo = $Article->getArticle($_POST["article_id"]);
            $result->response = $Article->deleteArticle($_POST["article_id"]);
            Helper::addLog("delete-article", $session['user_id'], $articleInfo->page_name);
        }

        echo json_encode($result);
    }
}
