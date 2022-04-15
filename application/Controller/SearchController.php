<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Article;
use Mini\Model\Page;
use Mini\Model\Shelter;

class SearchController
{
    public function index(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        header("Location: " . URL . 'error');
    }

    public function all($string){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $string = str_replace("-", " ", $string);
        $title = "Search: ". $string;
        $current_page = "dashboard";
        $searchType = "all";
        $Shelter = new Shelter();
        $Article = new Article();
        $Page = new Page();

        $shelters = $Shelter->getSheltersBySearch($string);
        $articles = $Article->getArticlesBySearch($string);
        $pages = $Page->getPagesBySearch($string);

        $results = array();

        foreach ($shelters as $shelter){
            $item = new \stdClass();
            $item->title = $shelter->shelter_name;
            $item->url = URL . 'shelters/edit/'. $shelter->id;
            $item->description = 'Result of Shelters. ';
            if(!empty($shelter->street_address)) $item->description .= $shelter->street_address.', ';
            if(!empty($shelter->city)) $item->description .= $shelter->city.'. ';
            if(!empty($shelter->contact_title)) $item->description .= $shelter->contact_title. '. ';
            if(!empty($shelter->contact_name)) $item->description .= $shelter->contact_name . '. ';
            if(!empty($shelter->phone_numner)) $item->description .= $shelter->phone_numner . '. ';
            if(!empty($shelter->email_address)) 'E-mail: '. $shelter->email_address.'.  ';
            if(!empty($shelter->website)) 'Website: <a href="'.$shelter->website .'" target="_blank">'.$shelter->website.'</a>';

            array_push($results, $item);
        }

        foreach ($articles as $article){
            $item = new \stdClass();
            $item->title = $article->page_name;
            $item->url = URL . 'articles/edit/'. $article->id;
            $item->description = 'Result of articles. ';
            if(!empty($article->content_short)) $item->description .= 'Resume: '.strip_tags($article->content_short);

            array_push($results, $item);
        }

        foreach ($pages as $page) {
            $item = new \stdClass();
            $item->title = $page->page_name;
            $item->url = URL . 'pages/edit/'. $page->id;
            $item->description = 'Result of pages. ';

            $content = strip_tags($page->content);
            if(strlen($content)<=500) {
                $item->description .= 'Resume: '.$content;
            } else {
                $item->description .= 'Resume: '.substr($content, 0, 500).'...';
            }
            array_push($results, $item);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/search/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function shelters($string){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $string = str_replace("-", " ", $string);
        $title = "Search: ". $string;
        $current_page = "dashboard";
        $searchType = "shelters";
        $Shelter = new Shelter();

        $shelters = $Shelter->getSheltersBySearch($string);

        $results = array();

        foreach ($shelters as $shelter){
            $item = new \stdClass();
            $item->title = $shelter->shelter_name;
            $item->url = URL . 'shelters/edit/'. $shelter->id;
            $item->description = 'Result of Shelters. ';
            if(!empty($shelter->street_address)) $item->description .= $shelter->street_address.', ';
            if(!empty($shelter->city)) $item->description .= $shelter->city.'. ';
            if(!empty($shelter->contact_title)) $item->description .= $shelter->contact_title. '. ';
            if(!empty($shelter->contact_name)) $item->description .= $shelter->contact_name . '. ';
            if(!empty($shelter->phone_numner)) $item->description .= $shelter->phone_numner . '. ';
            if(!empty($shelter->email_address)) 'E-mail: '. $shelter->email_address.'.  ';
            if(!empty($shelter->website)) 'Website: <a href="'.$shelter->website .'" target="_blank">'.$shelter->website.'</a>';

            array_push($results, $item);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/search/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function articles($string){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $string = str_replace("-", " ", $string);
        $title = "Search: ". $string;
        $current_page = "dashboard";
        $searchType = "articles";
        $results = array();
        $Article = new Article();
        $articles = $Article->getArticlesBySearch($string);

        foreach ($articles as $article){
            $item = new \stdClass();
            $item->title = $article->page_name;
            $item->url = URL . 'articles/edit/'. $article->id;
            $item->description = 'Result of articles. ';
            if(!empty($article->content_short)) $item->description .= 'Resume: '.strip_tags($article->content_short);

            array_push($results, $item);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/search/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function pages($string){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $string = str_replace("-", " ", $string);
        $title = "Search: ". $string;
        $current_page = "dashboard";
        $searchType = "pages";

        $Page = new Page();
        $pages = $Page->getPagesBySearch($string);
        $results = array();

        foreach ($pages as $page) {
            $item = new \stdClass();
            $item->title = $page->page_name;
            $item->url = URL . 'pages/edit/'. $page->id;
            $item->description = 'Result of pages. ';

            $content = strip_tags($page->content);
            if(strlen($content)<=500) {
                $item->description .= 'Resume: '.$content;
            } else {
                $item->description .= 'Resume: '.substr($content, 0, 500).'...';
            }

            array_push($results, $item);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/search/index.php';
        require APP . 'view/_templates/footer.php';
    }
}