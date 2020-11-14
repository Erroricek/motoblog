<meta charset="utf-8" />
<script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
<!-- <script type="text/javascript" src="../API/seznamMapyLoaderAPI.js"></script> -->
<script type="text/javascript">Loader.load();</script>
<div id="m" style="height:600px; width:800px"></div>

<script>
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

// // a
// SMap.Coords.fromWGS84(16.5601071373795, 48.81331908940705);

// // b
// let points = [[16.5601071373795, 48.81331908940705], [16.5601071373795, 48.81331908940705]];
// let polyline = new SMap.Geometry(SMap.GEOMETRY_POLYLINE, null, points, options);

fetch('03132231.json')
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

</script>


<?php
function ExplodeRawDataToJSONArray(){
    $xmldata = simplexml_load_file("records/dontusegoogleformat/05_09_2020_12_34.gpx") or die("Failed to load"); // 1) načíst xml soubor a rozebrat ho (parsovat)
    /* $name = $xmldata->trk->name; */
    $name = "03132231";
    $data = $xmldata->trk->trkseg->trkpt;
    $omezeni = 2;
    for ($i = 0; $i < count($data); $i+=$omezeni) {                 // toto udela s kazdym zaznamem
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
    zpracovavacDoJson($a, $name);
    
}
function zpracovavacDoJson($array, $name)                       //převede PHP array do JSON
{
    file_put_contents($name.".json", json_encode($array));
}
function putArrayToTextFile($array, $name)                             //veme surový ouput z GPSTracker a vypíše jednotlivý bod do souboru
{
    $file = fopen("$name.txt", "w");
    foreach ($array as $bod) {
        fwrite($file, "SMap.Coords.fromWGS84(" . $bod['lon'] .", " . $bod['lat'] .")");
        if($bod !== count($array)-1){
            fwrite($file, ",");
        }
        fwrite($file, "\n");
    }
    fclose($file);
}



//ExplodeRawDataToJSONArray();





?>
