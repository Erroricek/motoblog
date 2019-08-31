<?php
if($isAdmin){
    if(isset($_POST['submit'])){
        $nazev = $_POST['nazev'];
        $perex = $_POST['perex'];
        $content = $_POST['content'];
        $id = $_POST['id'];
        $url = preg_replace('/\W+/', '-', strtolower($nazev));
        
        if($id == ''){
            $sql = "INSERT INTO posts (nazev, perex, content, url, datum) VALUES ('$nazev', '$perex', '$content', '$url', NOW())";
        } else {
            $sql = "UPDATE posts SET nazev = '$nazev', perex = '$perex', content = '$content' WHERE id=" . (int)$id;
        }
        if($conn->query($sql)){
            echo "uspesne ulozeno";
        }else{
            echo"neuspesne ulozeni: ". $conn->error;
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
    
    
    <form action="index.php?page=form" method="post">
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
        <button name="submit" type="submit" class="btn btn-secondary btn-lg btn-block">Poslat</button>
    </form>
    
    <?php
    }
} else{
    echo"nemas opravneni";
}
?>
