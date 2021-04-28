<?php


class TicketRepository extends Db
{
    public function getAllRoutes() {
        $sql = "
             SELECT route_id, 
                    (select city from stations where station_id = from_station_id) as from_city, 
                    (select city from stations where station_id = to_station_id) as to_city,  
                    time_minutes, price_f_class, price_s_class, time_of_travel
            FROM station_routes         
        ";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTicketPrices($route_id) {
        $sql = "
            SELECT price_f_class, price_s_class
            FROM station_routes
            WHERE route_id = :route_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":route_id", $route_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTicket($data) {
        $route_id = $data["route_id"];
        $ticket_prices = $this->getTicketPrices($route_id);
        $price_1st_class = $ticket_prices["price_f_class"];
        $price_2nd_class = $ticket_prices["price_s_class"];
        $final_price = $price_1st_class * $data["passengers_1st"] + $price_2nd_class * $data["passengers_2nd"];

        $sql = "
            INSERT INTO tickeds (ticked_id, user_id, route_id, time_bought, number_of_f_class, number_of_2_class, final_price) 
            VALUES (NULL, :user_id, :route_id, current_timestamp(), :passengers_1st, :passengers_2nd, :final_price);  
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":user_id",  $data["user_id"], PDO::PARAM_INT);
        $stmt->bindValue(":route_id",  $data["route_id"], PDO::PARAM_INT);
        $stmt->bindValue(":passengers_1st",  $data["passengers_1st"], PDO::PARAM_INT);
        $stmt->bindValue(":passengers_2nd",  $data["passengers_2nd"], PDO::PARAM_INT);
        $stmt->bindValue(":final_price",  $final_price, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}