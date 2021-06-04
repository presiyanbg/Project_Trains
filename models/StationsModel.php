<?php


class StationsModel extends BaseModel
{
    private $stationsRepository;

    function __construct() {
        $this->stationsRepository = new StationsRepository();
    }

    public function createStation($data)
    {
        return $this->stationsRepository->createStation($data);
    }

    public function createRoute($data) {
        return $this->stationsRepository->createRoute($data);
    }

    public function createComment($data) {
        return $this->stationsRepository->createComment($data);
    }

    public function view($id)
    {
        // TODO: Implement view() method.
    }

    public function viewStation($id) {
        return $this->stationsRepository->getStation($id);
    }

    public function viewStationComments($id) {
        return $this->stationsRepository->getStationComments($id);
    }

    public function viewRoute($id) {
        return $this->stationsRepository->getRoute($id);
    }

    public function listAll()
    {
        return $this->stationsRepository->getAll();
    }

    public function searchStation($data) {
        return $this->stationsRepository->searchStation($data);
    }

    public function listAllRoutes() {
        return $this->stationsRepository->getAllRoutes();
    }

    public function update($data)
    {
        $this->stationsRepository->updateStation($data);
    }

    public function updateRoute($data)
    {
        $this->stationsRepository->updateRoute($data);
    }

    public function delete($id)
    {
        $this->stationsRepository->delete($id);
    }

    public function deleteRoute($id) {
        $this->stationsRepository->deleteRoute($id);
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }
}