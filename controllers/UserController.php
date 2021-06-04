<?php


class UserController extends BaseController
{
    private $userModel;

    function __construct() {
        $this->userModel = new UserModel();
    }

    public function viewUser() {
        return array($this->userModel->viewUserComments($_GET['user_id']), $this->userModel->viewUserTickets($_GET['user_id']));
    }

    public function updateUser() {
        if (!empty($_POST) && !empty($_POST["update"])) {
            $this->userModel->update($_POST);

            header("Location: index.php");
        } else {
            return $this->userModel->view($_GET['user_id']);
        }
    }

}