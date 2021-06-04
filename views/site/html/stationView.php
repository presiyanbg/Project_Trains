<?php


echo "
<div class='shell'>
    <div class='section'>
        <div class='section__title'>
            <h3> ". $data[0]->country . " / " . $data[0]->city . " </h3> 
       </div>
            
       <div class='section__content'>  
            <div class='section__image'>
                <img src='" . IMG_PATH . $data[0]->picture . "'/>
            </div>
        
            <div class='station__comments'>";
            if (!empty($_SESSION["uid"])) {
                $user_id = intval($_SESSION["uid"]);
                $station_id = $data[0]->station_id;

                echo "        
                <div class='station__comments--new'>
                    <form action='" . APPLICATION_PATH . "index.php?controller=stations&action=comment' method='post'>
                        <input type='text' name='user_id' value='$user_id' hidden>
            
                        <input type='text' name='comment'>
            
                        <button class='button button__comment' name='station_id' value='$station_id'>Comment</button>
                    </form>
                </div>
                ";
            }

            echo "<div class='station__comment--list'>";
                foreach ($data[1] as $comment) {
                    echo "<div class='station__comment--box  clear--fix'>";
                        echo "<div class='comment__text'> 
                                <p>";
                                echo $comment->text;
                        echo "  </p>
                            </div>";

                        echo "<div class='comment__user'> 
                                <p>";
                        echo $comment->f_name . " " . $comment->l_name;
                        echo "  </p>
                            </div>";

                        echo "<div class='comment__date'> 
                                    <p>";
                        echo $comment->date;
                        echo "  </p>
                            </div>";
                    echo "</div>";
                }

echo "        </div>
            </div>
        </div>
    </div>
</div>
";
