<?php
 

$post = isset($_GET['post']) ? $_GET['post'] : NULL;




if($post!=NULL){
    $sql = "SELECT * FROM posts WHERE url = '" . $post . "'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h2> " . $row["nazev"] . "</h2>";
            echo "<h3> " . date("d.m.Y H:i", strtotime($row["datum"])) . "</h3>";
            echo "<p> " . $row["perex"] . "</p>";
            echo "<p> " . $row["content"] . "</p>";

        }
    } else {
        echo "clanek nenalezen";
    }
} else {
    $sql = "SELECT * FROM posts";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        echo "<div class=\"card-deck\">";
        while($row = $result->fetch_assoc()) {
            //echo $row["nazev"]. " - " . $row["perex"] . " - " . $row["datum"];
            ?>
            <a href="?page=post&post=<?= $row["url"]?>">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <?= $row["nazev"]?> </h5>
                        <p class="card-text"><?= $row["perex"]?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?= date("d.m.Y H:i", strtotime($row["datum"]))?></small>
                    </div>
                    <?php
                    if($isAdmin)
                        echo "<a href='?page=form&edit-id=" . $row["id"] . "'>edit</a>";
                    ?>
                </div>
            </a>
<?php
        
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
    $conn->close();
}






?>