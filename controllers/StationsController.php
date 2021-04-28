<?php


class StationsController extends BaseController
{
    private $stationsModel;
    private $uploadManager;

    function __construct() {
        $this->stationsModel= new StationsModel();
        $this->uploadManager = new UploadManager();
    }

    public function CreateNewStation() {
        if (!empty($_POST) && !empty($_POST["create"])) {
            if (empty($_FILES["file_to_upload"]["error"])) {
                $file_name = $this->uploadManager->uploadImg(); // 12321321_duck.jpg | false
                if (!$file_name) {
                    return false;
                } else {
                    $_POST["picture"] = $file_name;
                }
            }

            $this->stationsModel->createStation($_POST);

            header("Location: index.php?controller=stations&action=listAll");
        } else {
            return true;
        }
    }

    public function CreateNewRoute() {
        if (!empty($_POST) && !empty($_POST["create"])) {
            $this->stationsModel->createRoute($_POST);

            header("Location: index.php?controller=stations&action=listAll");
        } else {
            return $this->listAll();
        }
    }

    function view() {
        Debug::parseAndDie($_POST);
    }

    function viewRoute() {
        Debug::parseAndDie($_POST);
    }

    public function listAll() {
        return $this->stationsModel->listAll();
    }

    public function SeeAllRoutes() {
        return $this->stationsModel->listAllRoutes();
    }

    function delete() {
        $this->stationsModel->delete($_POST['station_id']);

        header("Location: index.php?controller=stations&action=listAll");
    }

    function deleteRoute() {
        $this->stationsModel->deleteRoute($_POST['route_id']);

        header("Location: index.php?controller=stations&action=listAll");
    }

}