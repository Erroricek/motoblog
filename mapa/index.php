<?php

  $xmldata = simplexml_load_file("./xml_google.kml") or die("Failed to load"); // 1) načíst xml soubor a rozebrat ho (parsovat)
  
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
    
    $center_point = $data[ (int)round(count($data)/2) ];
    $center_atributy = $center_point->attributes();
    $Clon = $center_atributy["lon"]; // šíška
    $Clat = $center_atributy["lat"]; // delka
  
  $mapa = "http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDetcrsWJduGP3ti9J_NvAcJephicGTpWo&size=600x400&zoom=17&center=$Clat,$Clon&path=color:0xff0000ff|weight:5|$points";



  file_put_contents("mapa.png",file_get_contents($mapa)); // ukládá z googlu do png

?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>Cesta 1</h2>
  <img src="mapa.png" alt="mapa">
  
  
</body>
</html>
  