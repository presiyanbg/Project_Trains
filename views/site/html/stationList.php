<?php

if (is_array($data)) {
    $stations = $data;
    usort($stations, "sortStationsByRating");
    $stations = array_reverse($stations);
}
//Display Stations
$topThree = 1;

echo "
    <div class='shell'>
        <div class='section section__main'>
            <div class='section__title'>
                <h1 >Stations</h1>
            </div>
            
            <div class='basic__form'>
                <form class='container' action='". APPLICATION_PATH."index.php?controller=stations&action=listAll' method='post'>
                    <div class='basic__form--search'>
                        <input name='stationSearch' placeholder='Station'>
                    
                        <button type='submit' class='button button_search' value='Search'><img src='/Project_Trains/views/css/images/search.png'></button>
                    </div>
                </form>
            </div>
            
            <div class='section__content'>
                <div class='stations__boxes'>
            
        ";

if (is_array($data)) {
foreach ($stations as $station) {
    echo $topThree <= 3 ? "<div class='station__box box--big'>" : "<div class='station__box box--small'>";

    echo "<a class='big' href='index.php?controller=stations&action=userViewStation&station_id=".$station->station_id."'>";

    echo "<div class='station__box__title'>";
        echo "<h3>";
            echo $station->country;
            echo " / ";
            echo $station->city;
        echo "</h3>";
    echo "</div>";

    echo "<div class='station__box__content'>";
        echo "<div class='station__box__image'>";
            echo "<img src='" . IMG_PATH . "$station->picture'/>";
        echo "</div>";
    echo "</div>";

    if (!empty($_SESSION["uid"]) && $_SESSION["uprivilege"] == "a") {
        echo "  <div class='admin'>
                    <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=viewStation' method='post'>
                        <button class='button button__red' name='station_id' value='$station->station_id'>Change</button>
                    </form>
                    
                    <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=delete' method='post'>
                        <button class='button button__red' name='station_id' value='$station->station_id'>Delete</button>
                    </form>
                </div>
                ";
    }

    echo "</a>
    </div>
    ";


    $topThree++;
    }
} else {
    echo $topThree <= 3 ? "<div class='station__box box--big'>" : "<div class='station__box box--small'>";

    echo "<a class='big' href='index.php?controller=stations&action=userViewStation&station_id=".$data->station_id."'>";

    echo "<div class='station__box__title'>";
        echo "<h3>";
        echo $data->country;
        echo " / ";
        echo $data->city;
        echo "</h3>";
    echo "</div>";

    echo "<div class='station__box__content'>";
        echo "<div class='station__box__image'>";
            echo "<img src='" . IMG_PATH . "$data->picture'/>";
        echo "</div>";
    echo "</div>";

    if (!empty($_SESSION["uid"]) && $_SESSION["uprivilege"] == "a") {
        echo "  <div class='admin'>
                    <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=viewStation' method='post'>
                        <button class='button button__red' name='station_id' value='$data->station_id'>Change</button>
                    </form>
                    
                    <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=delete' method='post'>
                        <button class='button button__red' name='station_id' value='$data->station_id'>Delete</button>
                    </form>
                </div>
                ";
    }

    echo "</a>
    </div>
    ";

}
echo "        </div>
            </div>
        </div>  
    </div>
    ";

//Sort Stations By Rating
function sortStationsByRating($a, $b) {
    return strcmp($a->average_rating, $b->average_rating);
}

?>