<?php

echo "
<div class='shell'>
    <div class='section'>   ";

foreach ($data as $route) {
    echo "<div class='routes__list'>";
        echo "<div class='routes__id'>
                  <h4>";
            echo "#" . $route->route_id;
        echo "    </h4>
            </div>";

        echo "
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=viewRoute' method='post'>
                    <button class='button button__red' name='route_id' value='$route->route_id'>View</button>
                </form>
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=deleteRoute' method='post'>
                    <button class='button button__red'  name='route_id' value='$route->route_id'>Delete</button>
                </form>
                ";
    echo "</div>";
}

echo "
    </div>
</div>
";