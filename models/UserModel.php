<?php


class UserModel extends BaseModel
{
    private $userRepository;

    function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    public function view($id)
    {
        return $this->userRepository->getUserInfo($id);
    }

    public function viewUserComments($id) {
        return $this->userRepository->getUserComments($id);
    }

    public function viewUserTickets($id) {
        return $this->userRepository->getUserTickets($id);
    }

    public function viewByUsernameAndPassword($username, $password) {
        return $this->userRepository->getByUsernameAndPassword($username, $password);
    }

    public function listAll()
    {
        // TODO: Implement listAll() method.
    }

    public function update($data)
    {
        $this->userRepository->updateUser($data);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}