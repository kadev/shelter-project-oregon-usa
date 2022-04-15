<?php

namespace Mini\Controller;

use Mini\Model\Song;

class FilesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        $current_page = "files";

        require APP . 'view/_templates/header.php';
        require APP . 'view/files/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function uploadImage(){

        header('Content-Type: application/json');
        //ini_set('memory_limit','16M');
        $error = false;

        $absolutedir = dirname(__FILE__);
        $dir = '/../../public/img/uploads/'.$_POST['folder'].'/';
        $serverdir = $absolutedir . $dir;

        $tmp = explode(',', $_POST['data']);
        $imgdata = base64_decode($tmp[1]);

        $extension = explode('.', $_POST['name']);
        $extension = strtolower(end($extension));
        $filename = substr($_POST['name'], 0, -(strlen($extension) + 1));
        $filename = $filename . '.' . substr(sha1(time()), 0, 6) . '.' . $extension;

        $handle = fopen($serverdir . $filename, 'w');
        fwrite($handle, $imgdata);
        fclose($handle);

        $response = array(
            "status" => "success",
            "url" => $dir . $filename . '?' . time(), //added the time to force update when editting multiple times
            "filename" => $filename
        );

        print json_encode($response);
    }
}
