<?php
require_once "navigation.php";

echo '
    <form class="container" action="'. APPLICATION_PATH.'index.php" method="post">
        <section class="logo">
            <h1>Project Trains</h1>
            <h6>New Registration</h6>
        </section>
        <input name="username" placeholder="Username" autocomplete="off">
        <input name="first_name" placeholder="First Name" autocomplete="off">
        <input name="last_name" placeholder="Last Name" autocomplete="off">
        <input name="email" placeholder="Email" autocomplete="off">
        <input name="password" type="password"  placeholder="Password" autocomplete="off">
        <input type="submit" name="sign_up" value="Sign Up"/>
        <a href="'. APPLICATION_PATH.'index.php?login=true">Alredy have a registration?</a>
    </form>
    ';

require_once "footer.php";
?>
