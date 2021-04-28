<?php
require_once "navigation.php";


if (!empty($data)) {
    switch ($_GET["action"]) {
        case "CreateNewStation":
            require_once "html/stationCreate.php";
            break;
        case "listAll":
            require_once "html/stationList.php";
            break;
        case "CreateNewRoute":
            require_once "html/routeCreate.php";
            break;
        case "SeeAllRoutes":
            require_once "html/routeList.php";
            break;
        default:
            require_once "html/stationList.php.php";
            break;
    }
}

require_once "footer.php";
?>

