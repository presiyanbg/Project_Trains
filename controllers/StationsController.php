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

    function viewStation() {
        return $this->stationsModel->viewStation($_POST['station_id']);
    }

    function userViewStation( ) {
        $station_info = $this->stationsModel->viewStation($_GET['station_id']);
        $station_comments = $this->stationsModel->viewStationComments($_GET['station_id']);

        return array($station_info, $station_comments);
    }

    function comment() {
        $this->stationsModel->createComment($_POST);

        header("Location: index.php?controller=stations&action=userViewStation&station_id=". $_POST['station_id']);
    }

    function updateStation() {
        if (!empty($_POST) && !empty($_POST["update"])) {
            if (empty($_FILES["file_to_upload"]["error"])) {
                $file_name = $this->uploadManager->uploadImg(); // 12321321_duck.jpg | false
                if (!$file_name) {
                    return false;
                } else {
                    $_POST["picture"] = $file_name;
                }
            }

            $this->stationsModel->update($_POST);

            header("Location: index.php?controller=stations&action=listAll");
        } else {
            return true;
        }
    }

    public function updateRoute() {
        if (!empty($_POST) && !empty($_POST["update"])) {
            $this->stationsModel->updateRoute($_POST);

            header("Location: index.php?controller=stations&action=SeeAllRoutes");
        } else {
            return true;
        }
    }

    public function viewRoute() {
        return array($this->stationsModel->viewRoute($_POST['route_id']), $this->listAll());
    }

    public function listAll() {
        if (!empty($_POST) && !empty($_POST["stationSearch"])) {
            if($_POST["stationSearch"]) {
                $searchResult = $this->stationsModel->searchStation($_POST["stationSearch"]);

                if ($searchResult == "") {
                    return $this->stationsModel->listAll();
                } else {
                    return $this->stationsModel->searchStation($_POST["stationSearch"]);
                }
            }
        } else {
            return $this->stationsModel->listAll();
        }
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