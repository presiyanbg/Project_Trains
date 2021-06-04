<?php
require_once "navigation.php";

echo '
<div class="shell">
    <div class="section">    
        <div class="basic__form">
             <form class="container" action="'. APPLICATION_PATH.'index.php" method="post">
                <div class="basic__form--title">
                    <h2>Login</h2>
                </div>
                
                <div class="basic__form--action">
                    <input name="username" placeholder="username" autocomplete="off">
                    
                    <input type="password" name="password" placeholder="password" autocomplete="off">
                    
                    <input type="submit" class="button button__red" value="Login"/>
                    
                    <a href="'. APPLICATION_PATH.'index.php?register=true">No registration?</a>
                </div>
            </form>
        </div>
    </div>
</div>
';

require_once "footer.php";
?>
