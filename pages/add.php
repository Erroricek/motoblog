<?php

function ExplodeRawDataToJSONArray($xmlFileInput, $targetFilePath){
    $xmldata = simplexml_load_file($xmlFileInput) or die("Failed to load"); // 1) načíst xml soubor a rozebrat ho (parsovat)
    // $name = $xmldata->trk->name;
    $name = "xml";
    $data = $xmldata->trk->trkseg->trkpt;
    for ($i = 0; $i < count($data); $i++) {                 // toto udela s kazdym zaznamem
        $zaznam = $data[$i];
        $atributy = $zaznam->attributes();                          //lon lat
        
        $lon = floatval($zaznam->attributes()["lon"]);              // šíška
        $lat = floatval($zaznam->attributes()["lat"]);              // delka
        $ele = floatval($zaznam->ele);                              // výška
        $time = new DateTime( trim($zaznam->time->__toString()) );  //den/čas
        $time = $time->format("d. m. Y - H:i:s");
        $speed = floatval($zaznam->extensions->speed);              //rychlost
        $length = floatval($zaznam->extensions->length);            //vzdálenost
        //$a[] = ['lon'=>$lon."", 'lat'=>$lat."", 'ele'=>$ele."", 'time'=>$time."", 'speed'=>$speed."", 'length'=>$length.""];
        $a[] = ['lon'=>$lon, 'lat'=>$lat, 'ele'=>$ele, 'time'=>$time, 'speed'=>$speed, 'length'=>$length];
    } 
    $center_point = $data[(int)round(count($data) / 2)];
    $center_atributy = $center_point->attributes();
    $Clon = $center_atributy["lon"]; // šíška
    $Clat = $center_atributy["lat"]; // delka
    zpracovavacDoJson($a, $name, $targetFilePath);
    
}
function zpracovavacDoJson($array, $targetFilePath)                       //převede PHP array do JSON
{
    file_put_contents($targetFilePath, json_encode($array));
}


function addToExistXml($array)         //todo
{
    json_decode($array);
    $array[] = "new data";
    zpracovavacDoJson($array, $targetFilePath);
}

// function putArrayToTextFile($array, $name)                             //veme surový ouput z GPSTracker a vypíše jednotlivý bod do souboru
// {
//     $file = fopen("$name.txt", "w");
//     foreach ($array as $bod) {
//         fwrite($file, "SMap.Coords.fromWGS84(" . $bod['lon'] .", " . $bod['lat'] .")");
//         if($bod !== count($array)-1){
//             fwrite($file, ",");
//         }
//         fwrite($file, "\n");
//     }
//     fclose($file);
// }








if($User){
    if($User && $User->isAdmin() ){
        if(isset($_POST['addPage'])){
            $nazev = $_POST['nazev'];
            $perex = $_POST['perex'];
            $content = $_POST['content'];
            
            $sql = "INSERT INTO posts (nazev, perex, content, datum) VALUES ('$nazev', '$perex', '$content',  NOW())";
            
            sqlcheck($sql, "uspesne uloženo");
            
            $postid = $conn->insert_id;
            
            // prepsat do OOP   sqlcheck("UPDATE posts SET url='". $conn->insert_id . "' WHERE id=". $postid);

            //ukladani obrazku
            $target = "galerie/posts/";
            $allowTypes = array('jpg','png','jpeg','gif');

            mkdir("galerie/posts/" . $postid);

            //fotky upload
            foreach($_FILES['files']['name'] as $key => $val){
                // File upload path
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $target . $postid . "/" . $fileName;
                
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes))
                {
                    // Upload file to server
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        Log::add("obrazek ulozen: $targetFilePath");
                        

                        //----------------------
                        //sem dát thum z fotek
                        //------------------------

                    }else{
                        Log::add("obrazek neulozen");

                    }
                }else{
                    echo("obrazek nepodporuju" . var_dump($_POST));
                    echo('<br>');
                    echo('<br>');
                    Log::add("obrázek nepodporuju" . var_dump($_POST));
                    echo('<br>');
                    echo('<br>');
                }
            }

            //xml input
            $allowTypes = array('xml','gpx','json');
            foreach($_FILES['xml_files']['name'] as $key => $val){
                // File upload path
                $fileName = "xml.json";
                $targetFilePath = $target . $postid . "/" . $fileName;
                
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes))
                {
                    if(ExplodeRawDataToJSONArray($_FILES["xml_files"]["tmp_name"][$key], $targetFilePath)){
                        Log::add("json ulozen: " . $targetFilePath);
                    }else{
                        Log::add("json neulozen" . $targetFilePath);
                    }
                }else{
                    echo("xml nepodporuju");
                }
            }
            //load xml
            
            if(isset($xmldata)){
                $xmldata = simplexml_load_file("./sample.xml") or die("Failed to load"); // 1) načíst xml soubor a rozebrat ho (parsovat)
                $data = $xmldata->trk->trkseg->trkpt;
                $points = "";


                for($i=0;$i<count($data);$i++)
                { // toto udela s kazdym zaznamem
                    $zaznam = $data[$i];
                    $atributy = $zaznam->attributes();
                
                    $lon = $atributy["lon"]; // šíška
                    $lat = $atributy["lat"]; // delka
                
                    $points .= $lat . "," . $lon;
                
                    if ($i+1 < count($data) ) { // až na poslední prvek přidá '|' na konec
                        $points .= "|";
                    }
                
                } // konec loop
                    
                    $center_point = $data[ (int)round(count($data)/2) ]; //střed
                    $center_atributy = $center_point->attributes();
                    $Clon = $center_atributy["lon"]; // centr šíška
                    $Clat = $center_atributy["lat"]; // centr delka
                
                $mapa = "http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDetcrsWJduGP3ti9J_NvAcJephicGTpWo&size=600x400&zoom=17&center=$Clat,$Clon&path=color:0xff0000ff|weight:5|$points";
                
                
                
                file_put_contents("mapa.png",file_get_contents($mapa)); // ukládá z googlu fotku png
                
            }






        }
        
        ?>
        
        
        <form action="index.php?page=add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">nazev</label>
                <input name="nazev" value="" type="text" class="form-control" id="exampleFormControlInput1" placeholder="sem napis nazev">
            </div>
        
            <div class="form-group">
                <label for="exampleFormControlTextarea1">perex</label>
                <textarea name="perex" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        
            <div class="form-group">
                <label for="exampleFormControlTextarea1">content</label>
                <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>fotky</label>
                <input type="file" name="files[]" multiple >
            </div>

            <div class="form-group">
                <label>xml</label>
                <input type="file" name="xml_files[]" >
            </div>

            <button name="addPage" type="submit" class="btn btn-secondary btn-lg btn-block">Poslat</button>
        </form>
        <form >
            
        </form>
        
        <?php
    } else{
        echo"nemas opravneni";
    }
}else{
    echo "nejsi přihlášený";
}
?>
