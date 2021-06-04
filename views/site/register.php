<?php
require_once "navigation.php";

echo '
<div class="shell">
    <div class="section">    
        <div class="basic__form">
             <form class="container" action="'. APPLICATION_PATH.'index.php" method="post">
                <div class="basic__form--title">
                    <h2>Registration</h2>
                </div>
    
                <div class="basic__form--action">
                    <input name="username" placeholder="Username" autocomplete="off">
                    
                    <input name="first_name" placeholder="First Name" autocomplete="off">
                    
                    <input name="last_name" placeholder="Last Name" autocomplete="off">
                    
                    <input name="email" placeholder="Email" autocomplete="off">
                    
                    <input name="password" type="password"  placeholder="Password" autocomplete="off">
                    
                    <input type="submit" class="button button__red" name="sign_up" value="Sign Up"/>
                    
                    <a href="'. APPLICATION_PATH.'index.php?login=true">Alredy have a registration?</a>
                </div>  
        </form>
        </div>
    </div>
</div>
    ';

require_once "footer.php";
?>
