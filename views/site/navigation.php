<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <!--<link rel="stylesheet" type="text/css" href="/ikt-second-year/views/css/main.css">-->
</head>
<body>
<nav>
    <ul>
        <section class="logo">
            <a href="<?php echo APPLICATION_PATH?>index.php"><h1>Project_Trains</h1></a>
        </section>
        <li><a href="<?php echo APPLICATION_PATH?>index.php?controller=blog&action=listAll">Blog</a></li>
        <li><a href="<?php echo APPLICATION_PATH?>index.php?controller=movies&action=listAll">Movies</a></li>
        <li><a href="<?php echo APPLICATION_PATH?>index.php?controller=tickets&action=listAll">Buy A Ticked</a></li>
        <li><a href="<?php echo APPLICATION_PATH?>index.php?controller=stations&action=listAll">Stations</a></li>
        <?php
        echo "<li>
                    <form action='" . APPLICATION_PATH . "index.php?login=true' method='post'>
                        <input type='submit' value='";
        echo (!empty($_SESSION["uid"])) ? "Logout" : "Login";

        echo "'>
                    </form>
                </li>";
        if (!empty($_SESSION["uid"]) && $_SESSION["uprivilege"] == "a") {
            echo "<li><a href='" . APPLICATION_PATH ."index.php?controller=stations&action=CreateNewStation' >Add New Station</a></li>";
            echo "<li><a href='" . APPLICATION_PATH ."index.php?controller=stations&action=SeeAllRoutes' >See All Routes</a></li>";
            echo "<li><a href='" . APPLICATION_PATH ."index.php?controller=stations&action=CreateNewRoute' >Add New Route</a></li>";
        }

        ?>
    </ul>
</nav>
<main>
    <section class="cover">
        <section class="spinner">
            <span class="dot1"></span>
            <span class="dot2"></span>
        </section>
    </section>
    <section class="content">
