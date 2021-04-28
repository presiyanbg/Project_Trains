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

    public function view($id)
    {
        // TODO: Implement view() method.
    }

    public function listAll()
    {
        return $this->stationsRepository->getAll();
    }

    public function listAllRoutes() {
        return $this->stationsRepository->getAllRoutes();
    }

    public function update($data)
    {
        // TODO: Implement update() method.
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