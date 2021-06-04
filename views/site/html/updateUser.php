<?php

echo '
<div class="shell">
    <div class="section">    
        <div class="basic__form">
             <form class="container" action="'. APPLICATION_PATH.'index.php?controller=user&action=updateUser" method="post">
                <div class="basic__form--title">
                    <h2>Update info</h2>
                </div>
                
                <div class="basic__form--action">
                    <input name="user_id" value="'. $_GET['user_id'] .'" hidden>
                
                    <input name="username" placeholder="Username" value="'. $data[0]->username .'" autocomplete="off">
                    
                    <input name="first_name" placeholder="First Name" value="'. $data[0]->f_name .'" autocomplete="off">
                    
                    <input name="last_name" placeholder="Last Name" value="'. $data[0]->l_name .'" autocomplete="off">
                    
                    <input name="email" placeholder="Email" value="'. $data[0]->email .'" utocomplete="off">
                    
                    <input name="password" id="passwordField1" type="password"  placeholder="Password" autocomplete="off">
                    
                    <input id="passwordField2" type="password"  placeholder="Password" autocomplete="off">
                    
                    <input name="new_password" type="password"  placeholder="New Password" autocomplete="off">
                    
                    <span id="passwordAlertNotMatch"></span>
                    
                    <input type="submit" class="button button__red" name="update" value="Update"/>
                </div>  
            </form>
        </div>
    </div>
</div>

<script>
    const passwordField1 = document.getElementById("passwordField1");
    const passwordField2 = document.getElementById("passwordField2");
    const passwordAlertSpan = document.getElementById("passwordAlertNotMatch")
    
    passwordField2.addEventListener("input",  (e) => {
        if (passwordField1.value != passwordField2.value) {
            passwordAlertSpan.innerText = "Passwords Do Not Match";
            passwordAlertSpan.className = "password__alert"; 
        } else {
            passwordAlertSpan.innerText = "";
            passwordAlertSpan.classList.remove("password__alert"); 
        }
    });
</script>
    ';