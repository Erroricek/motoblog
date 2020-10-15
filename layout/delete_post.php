<?php
if (isset($_GET['id_to_delete'])) {
    $id = $_GET['id_to_delete'];
    $sql = "DELETE FROM posts WHERE id=$id";
    if($conn->query($sql)){
        ?>
        <br>
        <div class="alert alert-danger alert-dismissable"> <?php

        echo '<h1>Uspesne smazano</h1>';
        ?> </div> <?php

        header("Refresh:5; url=index.php?page=posts");
    }else{
        echo"Neuspesne smazano: ". $conn->error;
    }

echo '<br> <a href="index.php?page=posts">příspěvky</a>';
    die();
}

?>