<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\Country;

class AnimalsController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Animals";
        $current_page = "animals";
        $Animal = new Animal();
        $custom_js = URL."js/animals.js";
        $datatables = true;

        $animals = $Animal->getAllAnimals();

        require APP . 'view/_templates/header.php';
        require APP . 'view/animals/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create animal";
        $current_page = "animals";
        $custom_js = array(
            0 => URL . "js/animals.js"
        );
        $Country = new Country();
        $countries = $Country->getAllCountries();

        require APP . 'view/_templates/header.php';
        require APP . 'view/animals/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addAnimal()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_animal"])) {
            $params = array();
            parse_str($_POST["data_animal"], $params);

            $Animal = new Animal();
            $result->response = $Animal->addAnimal($params);
            $last = Helper::getLastRecord("animals");
            Helper::addLog("create-animal", $session['user_id'], $last->id);
        }

        echo json_encode($result);
    }

    public function edit($animal_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit animal";
        $current_page = "animals";
        $custom_js = array(
            0 => URL . "js/animals.js"
        );
        $Animal = new Animal();
        $Country = new Country();
        $countries = $Country->getAllCountries();
        $animal = $Animal->getAnimal($animal_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/animals/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateAnimal()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_animal"]) and isset($_POST["animal_id"])) {
            $params = array();
            parse_str($_POST["data_animal"], $params);
            $Animal = new Animal();
            $params['id'] = $_POST["animal_id"];
            $result->response = $Animal->updateAnimal($params);
            Helper::addLog("update-animal", $session['user_id'], $_POST["animal_id"]);
        }

        echo json_encode($result);
    }

    public function deleteAnimal()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["animal_id"])) {
            $Animal = new Animal();
            $animalInfo = $Animal->getAnimal($_POST["animal_id"]);
            $result->response = $Animal->deleteAnimal($_POST["animal_id"]);
            Helper::addLog("delete-animal", $session['user_id'], $animalInfo->name);
        }

        echo json_encode($result);
    }
}