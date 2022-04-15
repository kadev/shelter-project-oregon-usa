<?php

namespace Mini\Controller;

use Mini\Model\SecurityLog;
use Mini\Model\State;
use Mini\Model\User;
use Mini\Libs\Helper;
use Mini\Model\UserPermissions;


class UsersController
{
    private $_state, $_user_permissions;

    function __construct() {
        $this->_state = new State();
        $this->_user_permissions = new UserPermissions();
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Users";
        $current_page = "users";
        $User = new User();
        $custom_js = URL."js/users.js";
        $datatables = true;

        $users = $User->getAllUsers();

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     *
     */
    public function login()
    {
        $result = new \stdClass();

        if(isset($_POST['username']) AND isset($_POST['password'])){
            $User = new User();
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);
            $user = $User->getUserByUsername($username);

            if(!empty($user) AND $user != FALSE) {
                if (password_verify($password, $user->password)) {
                    Helper::startSession(
                        array(
                            'user_id'=>$user->id,
                            'name'=> $user->first_name.' '.$user->last_name,
                            'username'=> $user->username,
                            'email'=> $user->email,
                            'privilege'=> $user->group_id,
                            'start'=> time(),
                            'expire'=> time() + (30 * 60)
                        )
                    );
                    Helper::addLog("log-in", $user->id, null);
                    $result->response = true;
                }else{
                    $result->response = false;
                    $result->message = "Wrong password, try again.";
                }
            }else{
                $result->response = false;
                $result->message = "We did not find users with those credentials.";
            }
        }else{
            $result->response = false;
            $result->message = "Please enter the required fields to login.";
        }

        echo json_encode($result);
    }

    public function logout()
    {
        Helper::killSession();
        header('Location: '.URL);
    }

    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create User";
        $current_page = "create-user";

        $custom_js = array(
            0 => URL."js/data-editor-permissions.js",
            1 => URL."js/users.js"
        );

        $states = $this->_state->getAllStates();

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addUser(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_user"])) {
            $params = array();
            parse_str($_POST["data_user"], $params);

            $User = new User();
            $result->response = $User->addUser($params);
            $last = Helper::getLastRecord("users");
            Helper::addLog("create-user", $session['user_id'], $last->id);

            if($last->group_id == 4 AND !empty($params['permissions'])){
                foreach($params['permissions'] as $permission){
                    $this->_user_permissions->add("data-editor-permissions-by-state", $last->id, $permission['state'], $permission['years']);
                }
            }
        }

        echo json_encode($result);
    }

    public function edit($user_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit user";
        $current_page = "users";

        $custom_js = array(
            0 => URL."js/data-editor-permissions.js",
            1 => URL."js/users.js"
        );

        $User = new User();
        $user = $User->getUser($user_id);
        $user->permissions = $this->_user_permissions->getByKeynameAndUserID("data-editor-permissions-by-state", $user->id, "all");

        $states = $this->_state->getAllStates();

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function profile()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "My Profile";
        $current_page = "users";
        $custom_css = array(
            0 => URL."plugins/fileuploads/css/fileupload.css"
        );
        $custom_js = array(
            0 => URL."plugins/fileuploads/js/fileupload.js",
            1 => URL."plugins/fileuploads/js/file-upload.js",
            2 => URL."js/users.js"
        );
        $User = new User();
        $user = $User->getUser($session['user_id']);

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/profile.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateProfile()
    {
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_profile"])) {
            $params = array();
            parse_str($_POST["data_profile"], $params);
            $User = new User();
            $session = Helper::getSession();
            $params['id'] = $session['user_id'];
            $result->response = $User->updateProfile($params);
            Helper::addLog("update-profile", $session['user_id'], null);
        }

        echo json_encode($result);
    }

    public function updateUser()
    {
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_user"]) AND isset($_POST["user_id"])) {
            $params = array();
            $session = Helper::getSession();

            parse_str($_POST["data_user"], $params);
            $User = new User();
            $params['id'] = $_POST["user_id"];
            $result->response = $User->updateUser($params);
            Helper::addLog("update-user", $session['user_id'], $_POST["user_id"]);

            $this->_user_permissions->deleteByKeynameAndUserID("data-editor-permissions-by-state", $params['id']);

            if($params['privilege'] == 4 AND !empty($params['permissions'])){
                foreach($params['permissions'] as $permission){
                    $this->_user_permissions->add("data-editor-permissions-by-state", $params['id'], $permission['state'], $permission['years']);
                }
            }
        }

        echo json_encode($result);
    }

    public function changePassword(){
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_password"])) {
            $params = array();
            $session = Helper::getSession();
            parse_str($_POST["data_password"], $params);

            $params = Helper::stripTags($params);

            $User = new User();

            if(!empty($params['password']) AND !empty($params['new-password']) AND !empty($params['confirm-new-password'])){
                if($params['new-password'] == $params['confirm-new-password']){
                    $user = $User->getUserByUsername($session['username']);

                    if(!empty($user)){
                        if(password_verify($params['password'], $user->password)){
                            $params['id'] = $session['user_id'];

                            if($User->changePassword($params)){
                                $result->response = true;
                                Helper::addLog("change-password", $session['user_id'], null);
                            }else{
                                $result->message = "Something went wrong. Try Again.";
                            }
                        }else{
                            $result->message = "Wrong password, try again.";
                        }
                    }else{
                        $result->message = "Something went wrong. Try Again.";
                    }
                }else{
                    $result->message = "The new passwords do not match.";
                }
            }else{
                $result->message = "Incorrect fields, please verify the information.";
            }
        }

        echo json_encode($result);
    }

    public function forceChangePassword(){
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_password"])) {
            $params = array();
            $session = Helper::getSession();
            parse_str($_POST["data_password"], $params);

            $params = Helper::stripTags($params);

            $User = new User();

            if(!empty($params['new-password']) AND !empty($params['confirm-new-password'])){
                if($params['new-password'] == $params['confirm-new-password']){
                    $user = $User->getUser($params['id']);

                    if(!empty($user)){
                        if($User->changePassword($params)){
                            $result->response = true;
                            Helper::addLog("force-change-password", $session['user_id'], $params['id']);
                        }else{
                            $result->message = "Something went wrong. Try Again.";
                        }
                    }else{
                        $result->message = "The user you want to edit does not exist.";
                    }
                }else{
                    $result->message = "Passwords do not match.";
                }
            }else{
                $result->message = "Empty require fields.";
            }
        }

        echo json_encode($result);
    }

    public function deleteUser(){
        $result = new \stdClass();
        $result->response = false;
        $session = Helper::getSession();
        $user = new User();

        if (isset($_POST["user_id"])) {
            $User = new User();
            $userInfo = $user->getUser($_POST["user_id"]);
            $result->response = $User->deleteUser($_POST["user_id"]);

            if(!empty($userInfo)){
                $userInfo = $userInfo->first_name.' '.$userInfo->last_name;
                Helper::addLog("delete-user", $session['user_id'], $userInfo);
            }
        }

        echo json_encode($result);
    }

    public function activity()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Activity Log";
        $current_page = "reports";
        $SecurityLog = new SecurityLog();
        $datatables = true;

        if($session['privilege'] == 1){
            $logs = $SecurityLog->getAllSecurityLogs();
        }else{
            $logs = $SecurityLog->getLogsByUser($session['user_id']);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/users/activity.php';
        require APP . 'view/_templates/footer.php';
    }
}
