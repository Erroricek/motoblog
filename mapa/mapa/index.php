<?php

$xmldata = simplexml_load_file("./xml_google.kml") or die("Failed to load"); // 1) načíst xml soubor a rozebrat ho (parsovat)
  
echo "<pre>";
//print_r(explode("\n",$xmldata->Document->Placemark->LineString->coordinates));
echo "</pre>";

$data = explode("\n",$xmldata->Document->Placemark->LineString->coordinates);

$points = "";

for($i=0;$i<count($data);$i++)
{ // toto udela s kazdym zaznamem
    /*
	$zaznam = $data[$i];
    $atributy = $zaznam->attributes();

    $lon = $atributy["lon"]; // šíška
    $lat = $atributy["lat"]; // delka
	*/

	if(empty($data[$i]))
	{
		continue;
	}
	$data[$i] = str_replace("\t","",$data[$i]);
	$zaznam = explode(",",$data[$i]);
	$lon = $zaznam[0]; // šíška
    $lat = $zaznam[1]; // delka
	

    $points .= $lat . "," . $lon;
	if($i==800){
		break;
	}
    if ($i+1 < count($data) ) { // až na poslední prvek přidá '|' na konec
      $points .= "|";
    }
	
	

} // konec loop


  $center_point = $data[ (int)round(count($data)/2) ]; //střed
  //var_dump($data);
  $center_atributy = explode(",", $center_point);
  $Clon = $center_atributy[0]; // centr šíška
  $Clat = $center_atributy[1]; // centr delka

$mapa = "http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDetcrsWJduGP3ti9J_NvAcJephicGTpWo&size=600x400&zoom=17&center=$Clat,$Clon&path=color:0xff0000ff|weight:5|$points";



file_put_contents("mapa.png",file_get_contents($mapa)); // ukládá z googlu fotku png

?>

