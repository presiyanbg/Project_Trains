<?php
require_once "navigation.php";


if (!empty($data)) {
    switch ($_GET["action"]) {
        case "viewUser":
            require_once "html/userPage.php";
            break;
        case "updateUser":
            require_once "html/updateUser.php";
            break;
        default:
            require_once "html/userPage.php";
            break;
    }
}

require_once "footer.php";
?>

