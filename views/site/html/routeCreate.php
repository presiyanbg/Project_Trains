<?php

echo "
<form action='" . APPLICATION_PATH . "index.php?controller=stations&action=CreateNewRoute' method='post' enctype='multipart/form-data'>
    <label>From Station</label>
    <select name='from_station' id='from_station'></select>
    <input type='text' name='from_station_id' id='from_station_id' hidden>
    
    <label>To Station</label>
    <select name='to_station' id='to_station'></select>
    <input type='text' name='to_station_id' id='to_station_id' hidden>
    
    <label>Travel Time (minutes)</label>
    <input type='text' name='time_minutes'><br>
    
    <label>Price 1st Class</label>
    <input type='text' name='price_f_class'><br>
    
    <label>Price 2st Class</label>
    <input type='text' name='price_s_class'><br>
    
    <label>Time Of Travel</label>
    <input type='time' name='time_of_travel'><br>

    <button name='create' value='true'>Create</button>
</form>
";

echo "
        <script>
            const stations = " . json_encode($data) . ";
            
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
            
            selectFrom.addEventListener('change', (e) => {
                connectOptionsToId();
            })
            
            selectTo.addEventListener('change', (e) => {
                connectOptionsToId();
            })
            
            addOptionsToSelect(selectFromID);
            addOptionsToSelect(selectToID);
            connectOptionsToId();
            
        </script>        
    ";
?>