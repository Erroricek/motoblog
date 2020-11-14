<?php
$conn = DB::getConnection();
$sql = "SELECT posts.*, avg(ratings.rating) AS prum FROM posts LEFT JOIN ratings ON ratings.post=posts.id GROUP BY posts.id ORDER BY datum DESC";
$rows = DB::query($sql);
if (!empty($rows)) {
    // output data of each row
    echo "<div class=\" row\">";
    foreach ($rows as $row) { 
        //var_dump($row);
        
        //var_dump(count(glob("galerie/posts/" . $row["id"] . "/main.*")[0]));    
?>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 p-3 post h-100">
            <a href="?page=post&post=<?= $row["id"] ?>" class="p-0">
                <?php
                if (count(glob("galerie/posts/" . $row["id"] . "/main.*")) == 0) {
                    echo "<img src=\"galerie/static_pictures/Image_not_available.png\" class=\"card-img-top\" alt=\"chybějící úvodní obrázek\">";
                } else {
                    $mainImage = glob("galerie/posts/" . $row["id"] . "/main.*")[0];
                    echo "<img src=\"$mainImage\" class=\"card-img-top\" alt=\"úvodní obrázek\">";
                }
                /*
                        if($mainImage)
                        {
                            echo "<img src=\"$mainImage\" class=\"card-img-top\" alt=\"úvodní obrázek\">";
                        }
                        else
                        {
                            echo "<img src=\"galerie/static_pictures/Image_not_available.png\" class=\"card-img-top\" alt=\"chybějící úvodní obrázek\">";
                        }
                        */
                ?>


                <!-- <img src="<?php  // echo glob("galerie/posts/" . $row["id"] . "/main.*")[0]; 
                                ?>" class="card-img-top" alt="uvodni obrazek"> -->
                <div class="card-body bg-light">
                    <h5 class="card-title text-dark overflow-hidden text-nowrap"> <?= $row["nazev"] ?> </h5>
                    <hr class="d-block w-50 mt-3 mb-0 mx-auto" />
                </div>
            </a>
            <p class="card-text bg-light  pb-3 my-0"><?= $row["perex"] ?></p>

            <div class="card-footer py-3 justify-content-between">
                <small class="text-muted ">
                    <?= date("d.m.Y H:i", strtotime($row["datum"])) ?>
                </small>
                <small class="text-right float-right">
                    <?php
                    include("scripts/stars.php");
                    if ($User && $User->isAdmin()) { ?>
                        <a class="btn btn-info p-1 px-2 m-0 mx-2 text-light" href='?page=edit&edit-id=<?= $row["id"] ?>'><i class="fas fa-pen"></i></a>
                    <?php }
                    ?>
                </small>
                <span class="clearfix"></span>
            </div>
    <?php echo "</div>"; // sloupce
    }
    echo "</div>"; // hlavní div
} else {
    echo "0 results";
}


    ?>