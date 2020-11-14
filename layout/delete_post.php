<?php
if (isset($_GET['id_to_delete'])) {
    $id = $_GET['id_to_delete'];
    $sql = "DELETE FROM posts WHERE id=$id";
    if(DB::query($sql)){
        display_errors("Uspesne smazano");
        $whereTheFileIs = "galerie/posts/". $_GET['id_to_delete'];
        if(file_exists($whereTheFileIs)){
            unlink($whereTheFileIs);
            //echo("Soubor " . $currentFileName . " Byl úspěšně smazán.");
            echo ('<div class="alert alert-success">' . $currentFileName . "</div>");
            //$_SESSION["success"][] = "Soubor " . $currentFileName . " byl úspěšně smazán.";
        }else {
            display_errors(["Soubor, který chceš právě smazat jsem nenašel. Soubor:  " . $whereTheFileIs]);
        }
        /* echo('
        <div class="alert alert-danger alert-dismissable">'.
            '<h1>Uspesne smazano</h1>'.
        '</div>');  */

       /*  header("Refresh:5; url=index.php?page=posts"); */
        ?>
        <script>
            setTimeout(function(){location.href="index.php?page=posts"} , 5000);   
            /* document.location.href = "index.php?page=posts"; */
        </script>
        
        <?php
    }else{
        echo"Neuspesne smazano: ". $conn->error;
    }

echo '<br> <a href="index.php?page=posts">příspěvky</a>';
}

?>