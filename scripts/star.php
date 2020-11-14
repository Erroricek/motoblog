<div class="float-right text-dark">
    <?php
        $activeUser = isset($_SESSION["id"]) && $_SESSION["id"] == $User->id;

        if($activeUser){
            $sql = "SELECT * FROM ratings WHERE user=$User->id AND post=$post";
            $result1 = DB::query($sql);
            $userID = $_SESSION["id"];
        }else{
            $userID = NULL;
        }

        if(isset($result1[0]["id"])){
            $post = (int)$result1[0]["post"];
            $jesteNehodnotil = false;
        }else{
            $jesteNehodnotil = true;
        }

        if($User =! NULL && $jesteNehodnotil && isset($_SESSION["id"])){
            //var_dump($jesteNehodnotil);
            if ($User && $jesteNehodnotil) {/*  */
                /* for ($i=1; $i <= 5; $i++) { 
                    $odkaz_hvezdy = "scripts/addRaiting.php?raiting=$i&post=$post&user=$User->id";
                    echo('<a class="mt-3" href="'.$odkaz_hvezdy.'"><i class="fas fa-star vyplnena"></i></a>');
                } */ 
                echo //smajlici
                ('
                    <a class="mt-3" href="scripts/addRaiting.php?raiting=1&post='.$post.'&user='.$userID.'"><i class="fas fa-angry vyplnena"></i></a>
                    <a class="mt-3" href="scripts/addRaiting.php?raiting=2&post='.$post.'&user='.$userID.'"><i class="fas fa-frown vyplnena"></i></a>
                    <a class="mt-3" href="scripts/addRaiting.php?raiting=3&post='.$post.'&user='.$userID.'"><i class="fas fa-smile vyplnena"></i></a>
                    <a class="mt-3" href="scripts/addRaiting.php?raiting=4&post='.$post.'&user='.$userID.'"><i class="fas fa-grin-beam vyplnena"></i></a>
                    <a class="mt-3" href="scripts/addRaiting.php?raiting=5&post='.$post.'&user='.$userID.'"><i class="fas fa-grin-stars vyplnena"></i></a>
                ');
            }   
        }else{
            include ("scripts/stars.php");
            echo '<a href="scripts/removeRating.php?user='. $userID .'&post='.$post.'" class="btn btn-info p-0 px-1 m-0 m-2 text-light d-inline-block"> <i class="fas fa-redo-alt"></i>  </a>';
        }
        if ($User && $jesteNehodnotil){
            echo("<br>");
        }
    ?>
</div>

