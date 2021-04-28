<?php

foreach ($data as $route) {
    echo $route->route_id;

    echo "
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=viewRoute' method='post'>
                    <button name='route_id' value='$route->route_id'>View</button>
                </form>
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=deleteRoute' method='post'>
                    <button name='route_id' value='$route->route_id'>Delete</button>
                </form>
                ";
}