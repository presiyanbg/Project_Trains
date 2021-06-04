<?php
?>

<div class="footer">
    <div class="footer__body">
        <div class="shell">
            <div class="footer__links">
                <ul>
                    <li>
                        <a href="<?php echo APPLICATION_PATH?>index.php">Home</a>
                    </li>

                    <li>
                        <a href="<?php echo APPLICATION_PATH?>index.php?controller=tickets&action=listAll">Buy A Ticked</a>
                    </li>

                    <li>
                        <a href="<?php echo APPLICATION_PATH?>index.php?controller=stations&action=listAll">Stations</a>
                    </li>

                    <?php
                    if (!empty($_SESSION["uid"])) {
                        echo "<li><a href='" . APPLICATION_PATH ."index.php?controller=user&action=viewUser&user_id=".  $_SESSION['uid']  ."' >". $_SESSION['full_name'] ."</a></li>";
                    }

                    if (!empty($_SESSION["uid"]) && $_SESSION["uprivilege"] == "a") {
                        echo "<li>
                                    <a  class='button button__link__red' href='" . APPLICATION_PATH ."index.php?controller=stations&action=CreateNewStation' >Add New Station</a>
                                    </li>";

                        echo "<li>
                                <a  class='button button__link__red' href='" . APPLICATION_PATH ."index.php?controller=stations&action=SeeAllRoutes' >See All Routes</a>
                                </li>";

                        echo "<li>
                                <a  class='button button__link__red' href='" . APPLICATION_PATH ."index.php?controller=stations&action=CreateNewRoute' >Add New Route</a>
                                </li>";
                    }

                    echo "<li>
                                    <form action='" . APPLICATION_PATH . "index.php?login=true' method='post'>
                                        <input type='submit' class='button button__link__red' value='";
                    echo (!empty($_SESSION["uid"])) ? "Logout" : "Login";

                    echo "'>
                                    </form>
                                </li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="background__image">
    <img src="/Project_Trains/views/css/images/background-texture.jpg">
</div>

</body>
</html>

