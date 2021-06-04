<?php


class StationsRepository extends Db
{
    public function createStation($data) {
        $sql = "
            INSERT INTO stations(station_id, country, city, average_rating, picture)
            VALUES(NULL, :country, :city, :average_rating, :picture)
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":country", $data["country"], PDO::PARAM_STR);
        $stmt->bindValue(":city", $data["city"], PDO::PARAM_STR);
        $stmt->bindValue(":average_rating", $data["average_rating"], PDO::PARAM_INT);
        $stmt->bindValue(":picture", $data["picture"], PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function createRoute($data) {
        $sql = "
            INSERT INTO 
                station_routes (route_id, from_station_id, to_station_id, time_minutes, price_f_class, price_s_class, time_of_travel)
            VALUES(NULL, :from_station_id, :to_station_id, :time_minutes, :price_f_class, :price_s_class, :time_of_travel)
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":from_station_id", $data["from_station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":to_station_id", $data["to_station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":time_minutes", $data["time_minutes"], PDO::PARAM_INT);
        $stmt->bindValue(":price_f_class", $data["price_f_class"], PDO::PARAM_INT);
        $stmt->bindValue(":price_s_class", $data["price_s_class"], PDO::PARAM_INT);

        $time_of_travel = $data["time_of_travel"] . ":00";
        $stmt->bindValue(":time_of_travel", $time_of_travel, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function createComment($data) {

        $sql = "
            INSERT INTO 
                comments (user_id, station_id, text)
            VALUES(:user_id, :station_id, :text)
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":user_id", $data["user_id"], PDO::PARAM_INT);
        $stmt->bindValue(":station_id", $data["station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":text", $data["comment"], PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getAll() {
        $sql = "
            SELECT * FROM stations
        ";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getStation($id) {
        $sql = "
            SELECT * FROM stations
            WHERE station_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getStationComments($id) {
        $sql = "
            SELECT f_name, l_name, text, date FROM comments
            JOIN user_credentials on user_credentials.user_id = comments.user_id
            WHERE station_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllRoutes() {
        $sql = "
            SELECT * FROM station_routes
        ";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRoute($id) {
        $sql = "
            SELECT * FROM station_routes
            WHERE route_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function searchStation($data) {
        $sql = "
            SELECT * FROM stations
            WHERE 
                city LIKE CONCAT('%', :user_search , '%') OR 
                country LIKE CONCAT('%', :user_search , '%') 
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":user_search", $data, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateStation($data) {
        $sql = "
            UPDATE 
                stations
            SET 
                country = :country,
                city = :city,
                average_rating = :average_rating,
                picture = :picture
            WHERE 
                station_id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $data["station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":country", $data["country"], PDO::PARAM_STR);
        $stmt->bindValue(":city", $data["city"], PDO::PARAM_STR);
        $stmt->bindValue(":average_rating", $data["average_rating"], PDO::PARAM_INT);
        $stmt->bindValue(":picture", $data["picture"], PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updateRoute($data) {
        $sql = "
            UPDATE 
                station_routes
            SET 
                from_station_id = :from_station_id,
                to_station_id = :to_station_id,
                time_minutes = :time_minutes,
                price_f_class = :price_f_class,
                price_s_class = :price_s_class,
                time_of_travel = :time_of_travel
            WHERE 
                route_id = :route_id
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":route_id", $data["route_id"], PDO::PARAM_INT);
        $stmt->bindValue(":from_station_id", $data["from_station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":to_station_id", $data["to_station_id"], PDO::PARAM_INT);
        $stmt->bindValue(":time_minutes", $data["time_minutes"], PDO::PARAM_INT);
        $stmt->bindValue(":price_f_class", $data["price_f_class"], PDO::PARAM_INT);
        $stmt->bindValue(":price_s_class", $data["price_s_class"], PDO::PARAM_INT);

        $time_of_travel = $data["time_of_travel"] . ":00";
        $stmt->bindValue(":time_of_travel", $time_of_travel, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "
            DELETE FROM stations WHERE station_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $sql2 = "
            DELETE FROM station_routes WHERE from_station_id = :id OR to_station_id = :id
        ";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt2->execute();
    }

    public function deleteRoute($id) {
        $sql = "
            DELETE FROM station_routes WHERE route_id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}