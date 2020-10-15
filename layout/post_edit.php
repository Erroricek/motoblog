
<?php


if($user->isAdmin()){
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
                echo("nepodporuju");
            }
        }

        if($conn->query($sql)){
            echo "Uspesne ulozeno";
        }else{
            echo"Neuspesne ulozeni: ". $conn->error;
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
            <label>Upload</label>
            <input type="file" name="files[]" multiple >
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