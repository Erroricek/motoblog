




<div class="py-3 content-block">
<?php

$post = isset($_GET['post']) ? $_GET['post'] : NULL;

function loadVideosImages($idPost)
{
    $id = $idPost;
    if(is_dir("galerie/posts/". $id)){ 
        $obrazky = scandir("galerie/posts/". $id);
        echo "<div class='row justify-content-center'>"; 
        
        $videoFormat = ["mp4", "avi"];
        $nezadouciData = [".", "..", "@eaDir"];
        for($i=0; $i<count($obrazky); $i++) {
            if(!file_exists("galerie/posts/" . $id . "/" . $obrazky[$i]) || in_array($obrazky[$i], $nezadouciData) ){
                continue;
            }
    
            $ext = pathinfo($obrazky[$i], PATHINFO_EXTENSION);
            if(in_array($ext, $videoFormat)){
                ?>
                
                <div class="col align-self-center col-sm-12 col-md-12 col-lg-9 m-3 embed-responsive embed-responsive-16by9">
                <video audio="muted" class="embed-responsive-item" controls>
                    <source src='galerie/posts/<?php echo "$id/$obrazky[$i]"; ?>' type="video/mp4"> 
                </video>
            </div>
            <?php
            continue;
            }
            
            
            $jmenoObrazku = $obrazky[$i]; ?>
            

            <div class='col-sm-6 col-md-6 col-lg-4 my-4'>
                <a target='_blank' href='galerie/posts/<?php echo "$id/$jmenoObrazku"; ?>' class="d-block">
                    <img class='shadow-box'  src='galerie/posts/<?php echo "$id/$jmenoObrazku"; ?>' alt='obrazek' style='width:100%'>
                </a>
            </div>

        
        
        <?php 
        
        }
        echo "</div>";

    }
    else{
        echo("error loading images");
    }
}




if($post!=NULL){
    $sql = "SELECT posts.*, avg(ratings.rating) AS prum FROM posts LEFT JOIN ratings ON ratings.post=posts.id WHERE posts.id = '" . $post . "' GROUP BY posts.id";
    $result = DB::query($sql);

    if ($result) {
        // output data of each row
            
        foreach($result as $row) { // strukturovy
            
            include ("scripts/star.php");
            

            echo "<h2>  " . $row["nazev"] . "</h2>";
            echo "<h5 class='py-1 float-right'> " . date("d.m.Y H:i", strtotime($row["datum"])) . "</h5>";
            echo "<p class='py-2 my-0'> " . $row["perex"] . "</p>";
            echo('<hr class="my-2">');
            echo "<p> " . $row["content"] . "</p>";

            $id = $row["id"];
             //import videa         jmeno je id.mp4
            if(file_exists("galerie/posts/" . $id . ".mp4")){
                ?>
                
                <!--
                <div class='col-sm-6 col-md-6 col-lg-4 my-4'>
                    <video width="1024" height="720" controls>
                            <source src='galerie/posts/<?php //echo "$id.mp4"; ?>' type="video/mp4">
                    </video>
                </div>
                -->
                <?php
            }
            loadVideosImages($id);
            
            include("layout/comments.php");
        }   
    } else {
        echo "clanek nenalezen";
    }
} else {
    echo "clanek neexistuje";
}

?>
</div>

<script type="text/javascript">Loader.load();</script>
<script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
<script>
window.onload = function () {
    let center = SMap.Coords.fromWGS84(16.5601071373795, 48.81331908940705);
    let m = new SMap(JAK.gel("m"), center, 13);
    m.addDefaultLayer(SMap.DEF_BASE).enable();
    m.addDefaultControls();
    
    let layer = new SMap.Layer.Geometry();
    m.addLayer(layer);
    layer.enable();
    
    let options = {
        color: "#f00",
        width: 3
    };
    xml.json
    fetch('xml.json')
        .then((res) => res.json())
        .then((data) => {
            let points = [];
            for(let i = 0; i < data.length; i++) {
                points.push(SMap.Coords.fromWGS84(data[i].lon, data[i].lat));
            }
            /* console.log(points); */
            let polyline = new SMap.Geometry(SMap.GEOMETRY_POLYLINE, null, points, options);
            layer.addGeometry(polyline);
        });   
}
</script>