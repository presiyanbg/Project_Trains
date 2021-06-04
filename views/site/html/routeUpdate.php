<?php

echo "
<div class='shell'>
    <div class='section'>   
        <div class='basic__form'>
            <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=UpdateRoute' method='post' enctype='multipart/form-data'>
                <div class='basic__form--action'>
                    <input type='text' name='route_id' value='" . $data[0]->route_id . "' hidden>
                    
                    <label>From Station</label>
                    <select name='from_station' id='from_station'></select>
                    <input type='text' name='from_station_id' id='from_station_id' value='" . $data[0]->from_station_id . " ' hidden>
                    
                    <label>To Station</label>
                    <select name='to_station' id='to_station'></select>
                    <input type='text' name='to_station_id' id='to_station_id' value='" . $data[0]->to_station_id . " ' hidden>
                    
                    <label>Travel Time (minutes)</label>
                    <input type='text' name='time_minutes' value=' " . $data[0]->time_minutes . " '><br>
                    
                    <label>Price 1st Class</label>
                    <input type='text' name='price_f_class' value=' " . $data[0]->price_f_class . " '><br>
                    
                    <label>Price 2st Class</label>
                    <input type='text' name='price_s_class' value=' " . $data[0]->price_s_class . " '><br>
                    
                    <label>Time Of Travel " . $data[0]->time_of_travel . " </label>
                    <input type='time' id='time_of_travel' name='time_of_travel' value=' " . $data[0]->time_of_travel . " '><br>
                
                    <button name='update' class='button button__red' value='true'>Update</button>
               </div>
            </form>
        </div>
    </div>
</div>

";

echo "
        <script>        
            const stations = " . json_encode($data[1]) . ";
            
            const selectFromID = 'from_station';
            const selectToID = 'to_station';
            
            const selectFrom = document.getElementById(selectFromID);
            const selectTo = document.getElementById(selectToID);
            
            let fromStationId = document.getElementById('from_station_id');
            let toStationId = document.getElementById('to_station_id');
            
            function addOptionsToSelect(selectID) {
                const select = document.getElementById(selectID);
                
                for (station of stations) {
                    let optionSelect = document.createElement('option');
                    optionSelect.text = station['city'];
                    select.add(optionSelect);
                }
            }
            
            function connectOptionsToId() {
                for (station of stations) {
                    if (station['city'] == selectFrom.value) {
                        fromStationId.value = station['station_id'];
                    }
                    
                    if (station['city'] == selectTo.value) {
                        toStationId.value = station['station_id'];
                    }
                }                
            }
            
            function connectIdToUptions() {
                for (station of stations) {
                    let station_id = parseInt(station['station_id']);
                    
                    if (station_id == parseInt(fromStationId.value)) {
                        selectFrom.value = station['city'];
                    }
                    
                    if (station['station_id'] == parseInt(toStationId.value)) {
                        selectTo.value = station['city'];
                    }
                }  
            }
            
            selectFrom.addEventListener('change', (e) => {
                connectOptionsToId();
            })
            
            selectTo.addEventListener('change', (e) => {
                connectOptionsToId();
            })
            
            addOptionsToSelect(selectFromID);
            addOptionsToSelect(selectToID);
            connectIdToUptions(); 
            
        </script>        
    ";
?>