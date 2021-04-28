<?php


$stations = $data;
usort($stations, "sortStationsByRating");
$stations = array_reverse($stations);

//Display Stations
$topThree = 1;

foreach ($stations as $station) {
    echo $topThree <= 3 ?  "<div class='big'>" : "<div class='small'>";

    echo $station->city;
    echo "<img width='100px' src='" . IMG_PATH . "$station->picture'/>";

    if (!empty($_SESSION["uid"]) && $_SESSION["uprivilege"] == "a") {
        echo "
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=view' method='post'>
                    <button name='station_id' value='$station->station_id'>View</button>
                </form>
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=delete' method='post'>
                    <button name='station_id' value='$station->station_id'>Delete</button>
                </form>
                ";
    }

    echo "</div>";


    $topThree++;
}

//Sort Stations By Rating
function sortStationsByRating($a, $b) {
    return strcmp($a->average_rating, $b->average_rating);
}
?>