<?php


class TicketModel extends BaseModel
{
    private $ticketRepository;

    function __construct() {
        $this->ticketRepository = new TicketRepository();
    }

    public function create($data)
    {
        return $this->ticketRepository->createTicket($data);
    }

    public function view($id)
    {
        // TODO: Implement view() method.
    }

    public function listAll()
    {
        return $this->ticketRepository->getAllRoutes();
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}