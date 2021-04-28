<?php
require_once "navigation.php";

echo '
<form class="container" action="'. APPLICATION_PATH.'index.php" method="post">
    <section class="logo">
        <h1>Login</h1>
        <h6>БДЖ</h6>
    </section>
    <input name="username" placeholder="username" autocomplete="off">
    <input type="password" name="password" placeholder="password" autocomplete="off">
    <input type="submit" value="Login"/>
    <a href="'. APPLICATION_PATH.'index.php?register=true">No registration?</a>
</form>
';

require_once "footer.php";
?>
