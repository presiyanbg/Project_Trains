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
        //INSERT INTO `station_routes` (`route_id`, `from_station_id`, `to_station_id`, `time_minutes`,
        // `price_f_class`, `price_s_class`, `time_of_travel`) VALUES (NULL, '1', '3', '23', '123', '123', '11:00:11');

        $sql = "
            INSERT INTO station_routes (route_id, from_station_id, to_station_id, time_minutes, price_f_class, price_s_class, time_of_travel)
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

    public function getAll() {
        $sql = "
            SELECT * FROM stations
        ";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllRoutes() {
        $sql = "
            SELECT * FROM station_routes
        ";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
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