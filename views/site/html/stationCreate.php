<?php

echo "
<div class='shell'>
    <div class='section'>   
        <div class='basic__form'>
            <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=CreateNewStation' method='post' enctype='multipart/form-data'>
                <div class='basic__form--action'>
                    <label>Country</label>
                    <input type='text' name='country'><br>
                    <label>City</label>
                    <input type='text' name='city'><br>
                    <label>Rating</label>
                    <input type='text' name='average_rating'><br>
                    <label>Picture</label>
                    <input type='file' name='file_to_upload'><br>
                    <button class='button button__red' name='create' value='true'>Create</button>
                </div>
            </form>
        </div>
    </div>
</div>  
";