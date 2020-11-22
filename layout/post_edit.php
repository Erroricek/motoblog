
<?php

function deleteVideoOrPicture($fileName, $postID)
{
    ?>
    <a style="color:red" class="btn p-1 px-2 m-0 mx-2" href='?page=edit&deleteVideoOrPicture=<?=$fileName?>&edit-id=<?=$postID?>'><i class="fas fa-trash-alt"></i></a>
    <?php
}


function editRemovePictureContent($idPost)
{
    if(is_dir("galerie/posts/". $idPost)){ 
        $obrazky = scandir("galerie/posts/". $idPost);
        //echo "<div class='row justify-content-center'>"; 
        
        $videoFormat = ["mp4", "avi"];
        $nezadouciData = [".", "..", "@eaDir"];
        for($i=0; $i<count($obrazky); $i++) {
            if(!file_exists("galerie/posts/" . $idPost . "/" . $obrazky[$i]) || in_array($obrazky[$i], $nezadouciData) ){
                continue;
            }
            $ext = pathinfo($obrazky[$i], PATHINFO_EXTENSION);
            if(in_array($ext, $videoFormat)){
                echo $obrazky[$i];
                deleteVideoOrPicture($obrazky[$i], $idPost);
                echo('<br>');

                ?>
                <!-- <div class="col align-self-center col-sm-12 col-md-12 col-lg-9 m-3 embed-responsive embed-responsive-16by9">
                    <video audio="muted" class="embed-responsive-item" controls>
                        <source src='galerie/posts/<?php //echo "$idPost/$obrazky[$i]"; ?>' type="video/mp4"> 
                    </video>
                </div> -->
            <?php
            continue;
            }      
            
            $jmenoObrazku = $obrazky[$i]; 
            echo $obrazky[$i];
            deleteVideoOrPicture($obrazky[$i], $idPost);
            echo('<br>');
            ?>
            
            <!-- <div class='col-sm-6 col-md-6 col-lg-4 my-4'>
                <a target='_blank' href='galerie/posts/<?php //echo "$idPost/$jmenoObrazku"; ?>' class="d-block">
                    <img class='shadow-box'  src='galerie/posts/<?php //echo "$idPost/$jmenoObrazku"; ?>' alt='obrazek' style='width:100%'>
                </a>
            </div> -->

        
        
        <?php 
        
        }
        
        //echo "</div>";
    }
    else{
        echo("error loading images");
    }




    
}




if($User->isAdmin()){
    if(isset($_GET['deleteVideoOrPicture'])){
        $currentFileName = $_GET['deleteVideoOrPicture'];
        $whereTheFileIs = "galerie/posts/". $_GET['edit-id']. "/" . $currentFileName;
        if(file_exists($whereTheFileIs)){
            unlink($whereTheFileIs);
            //echo("Soubor " . $currentFileName . " Byl úspěšně smazán.");
            echo ('<div class="alert alert-success">' . "Smazal jsi: " . $currentFileName . "</div>");
            //$_SESSION["success"][] = "Soubor " . $currentFileName . " byl úspěšně smazán.";
        }else {
            display_errors(["Soubor, který chceš právě smazat jsem nenašel. Soubor:  " . $whereTheFileIs]);
        }
    }

    if(isset($_POST['submit'])){
        $nazev = $_POST['nazev'];
        $perex = $_POST['perex'];
        $content = $_POST['content'];
        $id = $_POST['id'];
        //$url = preg_replace('/\W+/', '-', strtolower($nazev));
        
        if($id == ''){
            $sql = "INSERT INTO posts (nazev, perex, content, datum) VALUES ('$nazev', '$perex', '$content',  NOW())";
        } else {
            $sql = "UPDATE posts SET nazev = '$nazev', perex = '$perex', content = '$content' WHERE id=" . (int)$id;
        }
        
        //ukladani obrazku
        $target = "galerie/posts/";
        $allowTypes = array('jpg','png','jpeg','gif');
        
        
        
        if(isset($_FILES) && $_FILES['files']['name'][0] != ""  )
        {
            foreach($_FILES['files']['name'] as $key => $val){
                // File upload path
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $target . $id . "/" . $fileName;
                
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes))
                {
                    // Upload file to server
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        Log::add("obrazek ulozen: $targetFilePath");
                    }else{
                        Log::add("obrazek neulozen");
                    }
                }else{
                    echo("nepodporuju soubory" . var_dump($_FILES));
                }
            }
        }else {
            display_errors('Nemám žádné další obrázky, co bych přidal... Ale to nevadí. :)');
            echo('<br>');
            echo('<br>');
            ?>
            <a href="index.php?post=posts">Příspěvky</a>
            <?php
            
        }

        if($conn->query($sql)){
            /* echo "Uspesne ulozeno"; */
            $_SESSION['success'][] .= "Úspěšně uloženo";
            ?>
                <script>
                    setTimeout(function(){location.href="index.php?page=posts"} , 5000);   
                    
                </script>
            <?php
        }else{
            echo"Neuspesne ulozeni: ". $conn->error;
        }
        if(DB::query($sql)){
            
        }
    
    }else{
        if(isset($_GET['edit-id'])){
            $id = $_GET['edit-id'];
            
            $sql = "SELECT * FROM posts WHERE id=" . (int)$id;
            $result = $conn->query($sql);
            
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                $nazev = $data['nazev'];
                $perex = $data['perex'];
                $content = $data['content'];
            }
        }
    ?>
    
    
    <form action="index.php?page=edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="exampleFormControlInput1">nazev</label>
            <input name="nazev" value="<?= isset($nazev) ? $nazev : '' ?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sem napis nazev">
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">perex</label>
            <textarea name="perex" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= isset($perex) ? $perex : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">content</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= isset($content) ? $content : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Nahraj fotky</label>
            <input type="file" name="files[]" multiple >
        </div>
        
        <div>
        <?php
        
        /* TODO výpis fotek, mazání a zvolení hlavní fotky */
            editRemovePictureContent($id);
        
        
        ?>
        </div>
        
        <button name="submit" type="submit" class="btn btn-secondary btn-lg btn-block">Poslat</button>
        <a  class="btn btn-warning btn-lg btn-block" onclick="check_delete()">DELETE</a>
    </form>
    
    <?php
    }
} else{
    echo"nemas opravneni";
}
?>



<script>
    function check_delete() {
        var result = confirm("chceš opravdu smazat????");
        if (result) {
            document.location.href = "index.php?page=delete&id_to_delete=<?php echo $id ?>";
            
        }
    }

</script>