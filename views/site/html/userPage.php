<?php

echo "
<div class='shell'>
    <div class='section'>
        <div class='section__title '>
            <h1 >". $_SESSION['full_name'] ."</h1>
        </div> 
    
        <div class='section__content'>
            <div class='user__comments'>
                    <div class='user__comments--title'>
                        <h4> User Comments: </h4>
                    </div>
                
                    <div class='user__table'> 
                        <table>
                            <tr>
                                <th> Station # </th>
                                <th> Text </th>
                                <th> Date </th>
                            </tr>";

foreach ($data[0] as $comment) {
    echo "<tr>";
        echo "<td>" . $comment->station_id . "</td>";
        echo "<td>" . $comment->text . "</td>";
        echo "<td>" . $comment->date . "</td>";
    echo "</tr>";
}

echo         "</table>
        </div>
    </div>";

echo "<div class='user__tickets'>
        <div class='user__tickets--title'>
            <h4> User Tickeds: </h4>
        </div>
        
        <div class='user__table'> 
            <table>
                <tr>
                    <th> Ticked # </th>
                    <th> Route # </th>
                    <th> Time bought </th>
                </tr>";

foreach ($data[1] as $ticked) {
    echo "<tr>";
    echo "<td>" . $ticked->ticked_id . "</td>";
    echo "<td>" . $ticked->route_id . "</td>";
    echo "<td>" . $ticked->time_bought . "</td>";
    echo "</tr>";
}

echo         "</table>
        </div>
    </div>";

echo "<div class='user__options'>
                <ul>
                    <li>
                        <a class='button button_user' href='" . APPLICATION_PATH ."index.php?controller=user&action=updateUser&user_id=".  $_SESSION['uid']  ."' >
                            Change user settings
                        </a>
                    </li>
                    
                    <li>
                         <a href='" . APPLICATION_PATH . "index.php?login=true' class='button button_user'>Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>    
</div>    
";

?>

