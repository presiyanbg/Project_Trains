<?php
require_once "navigation.php";

if (!empty($_SESSION["uprivilege"])) {
    echo "
    <div class='shell'>
        <div class='section section__main'>
            <div class='section__title'>
                <h1> Buy a Ticked</h1>
            </div>
            
            <div class='section__content'>  
                <div class='form'>
                    <form action='" . APPLICATION_PATH . "index.php?controller=tickets&action=create' method='post' enctype='multipart/form-data'>          
                        <div class='form__body'>
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label class='form__label'>From</label>
                                 </div>
                                 
                                 <div class='form__col'>
                                    <select name='route_from' id='route_from'></select>
                                 </div> 
                            </div>
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label class='form__label'>To</label>
                                </div>
                                
                                <div class='form__col'>
                                    <select name='route_to' id='route_to'></select>
                                </div>
                            </div>
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label class='form__label'>Time of travel</label>
                                </div>
                                
                                <div class='form__col'>
                                    <select name='time_of_travel' id='time_of_travel'></select>
                                </div>
                             </div>
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Price 1st class</label>
                                </div>
                                        
                                <div class='form__col form__option'>    
                                    <span id='price_1st_class'></span>
                                </div>    
                            </div>
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Price 2st class</label>
                                </div>
                                    
                                <div class='form__col form__option'>     
                                    <span id='price_2nd_class'></span>
                                </div>
                            </div>
                    
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Тravel duration</label>
                                </div>
                                
                                <div class='form__col form__option'>
                                    <span id='time_minutes'></span>
                                </div>
                            </div>
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Passengers 1st Class </label>
                                </div>
                                    
                                <div class='form__col'>    
                                    <input name='passengers_1st' id='passengers_1st' type='number' min='0' value='1'>
                                </div>
                            </div>
                    
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Passengers 2st Class </label>
                                </div>
                                    
                                <div class='form__col'>    
                                    <input name='passengers_2nd' id='passengers_2nd' type='number' min='0' value='0'>
                                </div>
                            </div>        
                        
                            <div class='form__row'>
                                <div class='form__col'>
                                    <label>Final Price</label>
                                </div>
                                
                                <div class='form__col form__option'> 
                                    <span name='final_price' id='final_price'></span>
                                </div>
                            </div>
                        
                            <div class='hidden'>
                                <input type='text' hidden name='user_id' id='user_id'>
                                <input type='text' hidden name='route_id' id='route_id'>
                            </div>
                        </div>  

                        <div class='form__actions'>
                                <input type='submit' class='button button__red'  id='submit' value='buy'> 
                        </div>                 
                </form>
            </div>
        </div>
    </div>
</div>
        ";

    echo "
        <script>
            const routes = " . json_encode($data) . ";
            
            const select_from = document.getElementById('route_from');
            const select_to = document.getElementById('route_to');
            const select_time_of_travel = document.getElementById('time_of_travel');
            const span_price_1st_class = document.getElementById('price_1st_class');
            const span_price_2nd_class = document.getElementById('price_2nd_class');
            const span_time_minutes = document.getElementById('time_minutes');
            const passengers_1st = document.getElementById('passengers_1st');
            const passengers_2nd = document.getElementById('passengers_2nd');
            const final_price = document.getElementById('final_price');
            const route_id = document.getElementById('route_id');
            const user_id = document.getElementById('user_id');

            
            function addOptionsStationsFrom() { 
                let stations_from = [];
                
                for (let route of routes) {
                    if (!stations_from.includes(route.from_city)) {
                        stations_from.push(String(route.from_city));
                        
                        let option_from = document.createElement('option');
                        option_from.text = route.from_city;
                        select_from.add(option_from);
                    }
                }                
            }
            
            function addOptionsStationsTo(stationFrom) {
                let stations_to = [];
                
                clearSelectOptions('route_to');
                
                for (let route of routes) {
                    if (route.from_city == stationFrom && !stations_to.includes(route.to_city)) {
                        stations_to.push(String(route.to_city));
                        
                        let option_to = document.createElement('option');
                        option_to.text = route.to_city;
                        select_to.add(option_to);
                    } 
                }
                
                addOptionsTime();
            }
            
            function addOptionsTime() {
                const station_from = document.querySelector('#route_from option:checked').text;
                const station_to = document.querySelector('#route_to option:checked').text;
                
                clearSelectOptions('time_of_travel');
                
                for (let route of routes) {
                    if (route.from_city == station_from && route.to_city == station_to) {
                        
                        let option_time_of_travel = document.createElement('option');
                        option_time_of_travel.text = route.time_of_travel;
                        select_time_of_travel.add(option_time_of_travel);
                    }
                }
            }            
            
            function clearSelectOptions(selectName) {
                var select = document.getElementById(selectName);

                let length = select.options.length;
                
                if (length != null) {
                    for (i = length-1; i >= 0; i--) {
                        select.options[i] = null;
                    }
                }
                
            }
            
            function calculatePriceAndTime() {
                 for (let route of routes) {
                     if (route.from_city == select_from.value && route.to_city == select_to.value && route.time_of_travel == select_time_of_travel.value) {
                        span_price_1st_class.innerHTML = (route.price_f_class);
                        span_price_2nd_class.innerHTML = (route.price_s_class);
                        span_time_minutes.innerHTML = route.time_minutes + ' minutes';
                        route_id.value = route.route_id;
                        user_id.value = " . json_encode($_SESSION['uid']) . ";
                     }
                }
            }
            
            function calculateFinalPrice() {
                final_price.innerHTML = passengers_1st.value * span_price_1st_class.innerHTML + passengers_2nd.value * span_price_2nd_class.innerHTML;
            }
            
            select_from.addEventListener('change', (e) => {
                addOptionsStationsTo(select_from.value); 
                calculatePriceAndTime();
                calculateFinalPrice();
            });
            
            select_to.addEventListener('change', (e) => {
                addOptionsTime(); 
                calculatePriceAndTime();
                calculateFinalPrice();
            });
            
            passengers_1st.addEventListener('change', (e) => {
                calculatePriceAndTime();
                calculateFinalPrice();
            })
            
            passengers_2nd.addEventListener('change', (e) => {
                calculatePriceAndTime();
                calculateFinalPrice();
            })
            
            select_time_of_travel.addEventListener('change', (e) => {
                calculatePriceAndTime();
                calculateFinalPrice();
            })
            
            addOptionsStationsFrom();
            addOptionsStationsTo(select_from.value);
            addOptionsTime();
            calculatePriceAndTime();
            calculateFinalPrice();
        </script>        
    ";
} else {
        echo "
    <div class='shell'>
        <div class='section section__main'>
            <div class='section__title'>
                <h3> Buy a Ticked</h3>
            </div>
            
            <div class='section__content'>
                <div class='basic__form'>
                    <form action='" . APPLICATION_PATH . "index.php?login=true' method='post'>
                        <div class='basic__from--action'>
                            <input class='button button__red' type='submit' value='";
                            echo (!empty($_SESSION["uid"])) ? "Logout" : "Login Or Register here";
                            echo "'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        ";
}

require_once "footer.php";
?>
