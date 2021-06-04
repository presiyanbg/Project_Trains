<?php


class UserRepository extends Db
{
    public function create($data) {
        $sql = "
            INSERT INTO user_credentials(user_id, username, f_name, l_name, password, email, privilege_level)
            VALUES(NULL, :username, :f_name, :l_name, :password, :email, :privilege_level)
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindValue(":f_name", $data["first_name"], PDO::PARAM_STR);
        $stmt->bindValue(":l_name", $data["last_name"], PDO::PARAM_STR);
        $stmt->bindValue(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindValue(":privilege_level", "n", PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateUser($data) {
        $password = hash("sha256", $data["password"]);
        $check = $this->getByUsernameAndPassword($data["username"], $password);

        if (isset($check) && is_object($check)) {
            $sql = "
                UPDATE user_credentials
                SET username = :username, f_name = :f_name, l_name = :l_name, password = :password, email = :email
                WHERE user_id = :user_id;
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(":user_id", $data["user_id"], PDO::PARAM_INT);
            $stmt->bindValue(":username", $data["username"], PDO::PARAM_STR);
            $stmt->bindValue(":f_name", $data["first_name"], PDO::PARAM_STR);
            $stmt->bindValue(":l_name", $data["last_name"], PDO::PARAM_STR);

            $passwordNew = hash("sha256", $data["new_password"]);
            $stmt->bindValue(":password", $passwordNew, PDO::PARAM_STR);

            $stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    public function getUserInfo($id) {
        $sql = "
            SELECT username, f_name, l_name, email FROM user_credentials
            WHERE user_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserComments($id) {
        $sql = "
            SELECT * FROM comments
            WHERE user_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserTickets($id) {
        $sql = "
            SELECT * FROM tickeds
            WHERE user_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByUsernameAndPassword($username, $password) {
        $sql = "
            SELECT * FROM user_credentials
            WHERE username = :username AND password = :password
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}