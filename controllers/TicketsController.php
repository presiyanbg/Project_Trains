<?php


class TicketsController extends BaseController
{
    private $ticketModel;

    function __construct() {
        $this->ticketModel= new TicketModel();
    }

    public function listAll() {
        return $this->ticketModel->listAll();
    }

    public function create() {
         $this->ticketModel->create($_POST);

        header("Location: index.php?controller=stations&action=listAll");
    }
}