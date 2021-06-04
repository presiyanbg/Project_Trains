<?php


echo "
<div class='shell'>
    <div class='section'>
        <div class='section__title'>
            <h3>Updating Station: ". $data->country . " / ". $data->city ."</h3>
            
            <div class='basic__form'>
                <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=updateStation' method='post' enctype='multipart/form-data'>
                    <div class='basic__form--action'>
                        <input type='text' name='station_id'  value='". $data->station_id."' hidden>
                    
                        <label>Country</label>
                        <input type='text' name='country' value='". $data->country."'><br>
                        
                        <label>City</label>
                        <input type='text' name='city' value='". $data->city ."'><br>
                        
                        <label>Rating</label>
                        <input type='text' name='average_rating' value='". $data->average_rating ."'><br>
                        
                        <label>Picture</label>
                        <input type='file' name='file_to_upload' value='". $data->picture ."'><br>
                        
                        <button name='update' class='button button__red' value='true'>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
";