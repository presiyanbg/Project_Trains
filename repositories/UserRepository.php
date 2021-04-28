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